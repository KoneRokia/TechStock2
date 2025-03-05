<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LicenceExpirationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $licences;

    public function __construct($licences)
    {
        $this->licences = $licences;
    }

    public function build()
    {
        return $this->subject('Alerte : Licences expirant bientôt')
                    ->view('emails.licence_expiration');
    }
}
