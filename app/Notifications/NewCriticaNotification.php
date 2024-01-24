<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCriticaNotification extends Notification
{
    use Queueable;

    protected $usuarioCritica;
    protected $tituloAudiovisual;

    /**
     * Create a new notification instance.
     */
    public function __construct($usuarioCritica, $tituloAudiovisual)
    {
        $this->usuarioCritica = $usuarioCritica;
        $this->tituloAudiovisual = $tituloAudiovisual;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Personaliza el contenido del correo
        return (new MailMessage)
            ->line('Tu amigo ' . $this->usuarioCritica . ' ha realizado una crítica en el audiovisual ' .
                $this->tituloAudiovisual . ' de nuestra aplicación y queremos informarte al respecto.')
            ->action('Ver comentario de tu amigo', url('/'))
            ->line('¡Agradecemos la participación de tu amigo y esperamos que encuentres interesante su comentario!')
            ->line('¡Gracias por ser parte de nuestra comunidad!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
