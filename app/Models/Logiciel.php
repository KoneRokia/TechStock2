<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logiciel extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'version', 'date_achat', 'date_expiration','type', 'editeur', 'user_id', ];

    public function licences()
    {
        return $this->belongsToMany(Licence::class, 'licence_logiciel', 'logiciel_id', 'licence_id');
    }

    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'employe_logiciel', 'logiciel_id', 'employe_id');
    }
}
