<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'type', 'cout', 'etat', 'user_id', 'equipement_id'];

    // Relation avec l'utilisateur (technicien ou autre)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec l'équipement concerné
    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
