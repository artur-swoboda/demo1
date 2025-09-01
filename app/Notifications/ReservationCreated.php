<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Twoja rezerwacja została utworzona')
            ->greeting('Cześć ' . $notifiable->name . '!')
            ->line('Dziękujemy za dokonanie rezerwacji.')
            ->line('Usługa: ' . $this->reservation->service->name)
            ->line('Termin: ' . $this->reservation->slot->date . ' ' . $this->reservation->slot->time)
            ->line('Status: ' . ucfirst($this->reservation->status))
            ->line('Wkrótce admin potwierdzi Twoją rezerwację.');
    }
}
