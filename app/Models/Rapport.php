<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = ['date_generation', 'fichier', 'user_id', 'equipement_id', 'type',
    'titre', 'description'];

    // Relation avec l'utilisateur (créateur du rapport)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec l'équipement concerné par le rapport
    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}

