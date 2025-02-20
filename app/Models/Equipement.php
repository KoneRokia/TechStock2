<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'type', 'cout', 'etat', 'date_achat',
        'numero_serie', 'marque', 'caracteristique', 'photo_equip',
         'user_id'
    ];

    // Ajouter ceci pour convertir automatiquement les dates
    protected $dates = ['date_achat']; // Cette ligne est importante

    public function user()
    {
         return $this->belongsTo(User::class);


        // return $this->belongsToMany(Employe::class, 'employe_equipement');
    }

    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'employe_equipement');
    }

}

