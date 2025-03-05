<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class RenewalNotification extends Notification
{
    use Queueable;

    public $license;

    public function __construct($license)
    {
        $this->license = $license;
    }

    // Notification par base de données et par email
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // Contenu de la notification dans la base de données
    public function toDatabase($notifiable)
    {
        return [
            'license_name' => $this->license->name,
            'renewal_date' => $this->license->renewal_date,
            'message' => 'La licence ' . $this->license->name . ' doit être renouvelée bientôt.'
        ];
    }

    // Contenu de la notification par email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('La licence ' . $this->license->name . ' doit être renouvelée bientôt.')
                    ->action('Renouveler maintenant', url('/renewal/' . $this->license->id))
                    ->line('Merci d\'avoir utilisé notre service.');
    }
}









