<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class AppointmentConfirmed extends Notification
{
    public $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre rendez-vous du '.$this->appointment->date.' à '.$this->appointment->time.' a été confirmé.',
            'appointment_id' => $this->appointment->id
        ];
    }
}