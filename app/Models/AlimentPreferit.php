<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPreferit extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = 'aliments_preferits';

    /**
     * Funció que assigna una relació N:M amb la classe Planificacio
     */
    public function planificacio(){
        return $this->belongsToMany(Planificacio::class,'aliment_preferit_planificacio')->withTimestamps();
    }
}
