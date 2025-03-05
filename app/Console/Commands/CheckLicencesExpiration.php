<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Licence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LicenceExpirationMail;
use Illuminate\Notifications\Notifiable;

class CheckLicencesExpiration extends Command
{
    protected $signature = 'licences:check-expiration';
    protected $description = 'Vérifier les licences expirant bientôt et envoyer une alerte à l\'admin';

    public function handle()
    {
        $admin = User::where('role', 'admin')->first(); // Récupère l'admin
        if (!$admin) {
            $this->info('Aucun admin trouvé.');
            return;
        }

        $dateLimite = Carbon::now()->addDays(7); // Vérifie les licences expirant dans 7 jours
        $licences = Licence::whereDate('date_expiration', '<=', $dateLimite)->get();

        if ($licences->isEmpty()) {
            $this->info('Aucune licence n\'expire bientôt.');
            return;
        }

        Mail::to($admin->email)->send(new LicenceExpirationMail($licences));
        $this->info('Alerte de renouvellement de licence envoyée à l\'admin.');
    }

}
