<?php

namespace App\Livewire\Client\Reservations;

use Livewire\Component;
use App\Models\Reservation;

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
