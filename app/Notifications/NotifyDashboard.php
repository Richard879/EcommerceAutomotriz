<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyDashboard extends Notification
{
    use Queueable;

    public $GlobalDatos;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Array $datos)
    {
        $this->GlobalDatos = $datos;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Obtener la representación de la base de datos de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'datos' => $this->GlobalDatos
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'datos' => $this->GlobalDatos
        ];
    }
}
