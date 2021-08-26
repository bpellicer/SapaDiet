<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacio extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = 'planificacions';

    /**
     * Funció que assigna una relació 1:1 amb la classe User
     */
    public function user(){
        return $this->hasOne(User::class);
    }

    /**
     * Funció que assigna una relació N:M amb la classe AlimentPreferit
     */
    public function alimentpreferit(){
        return $this->belongsToMany(AlimentPreferit::class,'aliment_preferit_planificacio')->withTimestamps();
    }
}
