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
        return (new MailMessage)
            ->subject('Vos Identifiants de Connexion')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre compte a été créé avec succès !')
            ->line('Voici vos identifiants de connexion :')
            ->line('**Adresse e-mail :** ' . $this->email)
            ->line('**Mot de passe :** ' . $this->password)
            ->line('Ces identifiants ne sont connus que de vous.')
            ->line('__**Veuillez bien conserver ce mot de passe.**__')
            ->action('Connexion à votre compte', $this->for == 'partner'
                ? route('partner.auth.login')
                : route('dashboard.auth.login'))
            ->line('Merci de faire partie de notre communauté !');
    }
}
