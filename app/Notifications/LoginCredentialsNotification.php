<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginCredentialsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $for;
    public $email;
    public $password;

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param string $email
     * @param string $password
     */
    public function __construct($email, $password, $for)
    {
        $this->for = $for;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Définir les canaux de notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Construire le message d'e-mail.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $loginUrl = $this->for == 'partner'
            ? route('partner.auth.login')
            : route('dashboard.auth.login');

        return (new MailMessage)
            ->subject('Vos Identifiants de Connexion')
            ->view('mails.login_credentials', [
                'name' => $notifiable->name,
                'email' => $this->email,
                'password' => $this->password,
                'loginUrl' => $loginUrl,
            ]);
    }
}
