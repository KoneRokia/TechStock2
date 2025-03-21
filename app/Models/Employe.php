<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'poste',
        'date_embauche',
        'user_id',
        'statut',
    ];

    // Un employé peut avoir plusieurs équipements
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'employe_equipement');
    }

    // Un employé a été affecté par un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function logiciels()
    {
        return $this->belongsToMany(Logiciel::class, 'employe_logiciel', 'employe_id', 'logiciel_id');
    }


    // Désactiver la suppression en cascade (si c'était activé auparavant)
    public static function boot()
    {
        parent::boot();

        static::deleting(function($employe) {
            // Ne pas supprimer les historiques
            // Supprime cette ligne si elle existe : $employe->historiques()->delete();
        });
    }

}
