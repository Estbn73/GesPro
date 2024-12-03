<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Crear una nueva instancia de notificación.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Obtener la representación de correo de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Recupera tu Contraseña')
                    ->greeting('Hola,')
                    ->line('Recibiste este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.')
                    ->action('Restablecer Contraseña', url(route('password.reset', $this->token, false)))
                    ->line('Si no solicitaste un restablecimiento de contraseña, ignora este correo.')
                    ->salutation('Saludos, '.config('app.name'));
    }
}
