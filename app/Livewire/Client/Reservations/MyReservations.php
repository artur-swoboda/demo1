<?php

namespace App\Livewire\Client\Reservations;

use App\Models\Reservation;
use Livewire\Component;

class MyReservations extends Component
{
    public $reservations;

    public function render()
    {
        $this->reservations = Reservation::with(['service', 'slot'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.client.my-reservations');
    }
}
