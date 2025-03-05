<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable = [
        'cle_licence', 'type', 'nombre_utilisateurs', 'date_expiration', 'etat', 
    ];

    public function logiciels()
    {
        return $this->belongsToMany(Logiciel::class, 'licence_logiciel', 'licence_id', 'logiciel_id');
    }
}
