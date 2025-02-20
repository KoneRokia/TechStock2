<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipement_id',
        'ancien_utilisateur_id',
        'nouveau_utilisateur_id',
        'date_passation',
        'temps_utilisation',
    ];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }

    public function ancienUtilisateur()
    {
        return $this->belongsTo(Employe::class, 'ancien_utilisateur_id');
    }

    public function nouveauUtilisateur()
    {
        return $this->belongsTo(Employe::class, 'nouveau_utilisateur_id');
    }
}
