<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LicenceExpirationNotification extends Notification
{
    use Queueable;

    public $licences;

    public function __construct($licences)
    {
        $this->licences = $licences;
    }

    public function via($notifiable)
    {
        return ['database']; // Utiliser le canal base de données
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Licences expirant bientôt',
            'message' => 'Les licences suivantes expirent bientôt : ' . $this->getLicencesList(),
        ];
    }

    private function getLicencesList()
    {
        return $this->licences->map(function ($licence) {
            return $licence->nom . ' (Expiration : ' . $licence->date_expiration->format('d/m/Y') . ')';
        })->implode(', ');
    }
}
