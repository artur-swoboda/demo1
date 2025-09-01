<?php

namespace App\Livewire\Admin\Reservations;

use App\Notifications\ReservationStatusChanged;
use Livewire\Component;
use App\Models\Reservation;

class Index extends Component
{
    public $reservations;

    public function mount()
    {
        $this->loadReservations();
    }

    public function loadReservations()
    {
        $this->reservations = Reservation::with(['user', 'service', 'slot'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updateStatus($id, $status)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $status]);

        $reservation->user->notify(new ReservationStatusChanged($reservation));

        $this->loadReservations();

        session()->flash('success', 'Status rezerwacji zaktualizowany!');
    }

    public function render()
    {
        return view('livewire.admin.reservations.index');
    }
}
