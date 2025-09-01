<?php

namespace App\Livewire\Client\Reservations;

use App\Notifications\ReservationCreated;
use Livewire\Component;
use App\Models\Service;
use App\Models\Slot;
use App\Models\Reservation;

class ReservationForm extends Component
{
    public $services;
    public $slots;
    public $service_id;
    public $slot_id;

    public function mount()
    {
        $this->services = Service::all();
        $this->slots = Slot::where('is_available', true)
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }

    protected $rules = [
        'service_id' => 'required|exists:services,id',
        'slot_id' => 'required|exists:slots,id',
    ];

    public function reserve()
    {
        $this->validate();

        $slot = Slot::findOrFail($this->slot_id);

        if (!$slot->is_available) {
            session()->flash('error', 'Ten termin jest już zajęty!');
            return;
        }

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'service_id' => $this->service_id,
            'slot_id' => $this->slot_id,
            'status' => 'pending',
        ]);

        $slot->update(['is_available' => false]);

        $reservation->user->notify(new ReservationCreated($reservation));

        session()->flash('success', 'Rezerwacja złożona!');
        $this->reset(['service_id', 'slot_id']);
        $this->mount(); // odśwież listę slotów
    }

    public function render()
    {
        return view('livewire.client.reservation-form');
    }
}
