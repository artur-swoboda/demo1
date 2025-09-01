<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationStatusChanged extends Notification implements ShouldQueue
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
        $statusText = match ($this->reservation->status) {
            'confirmed' => 'Twoja rezerwacja została potwierdzona.',
            'cancelled' => 'Niestety Twoja rezerwacja została anulowana.',
            default => 'Status Twojej rezerwacji został zmieniony.',
        };

        return (new MailMessage)
            ->subject('Status Twojej rezerwacji')
            ->greeting('Cześć ' . $notifiable->name . '!')
            ->line($statusText)
            ->line('Usługa: ' . $this->reservation->service->name)
            ->line('Termin: ' . $this->reservation->slot->date . ' ' . $this->reservation->slot->time)
            ->line('Dziękujemy za korzystanie z naszego systemu.');
    }
}
