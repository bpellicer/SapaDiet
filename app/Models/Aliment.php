<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table="aliments";

    /**
     * Funció que assigna una relació N:1 amb la classe Categoria
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Funció que assigna una relació N:M amb la classe UserApat fent servir la classe UserApatAliment com a classe pivot
     */
    public function userApat(){
        return $this->belongsToMany(UserApat::class)->using(UserApatAliment::class)->withTimestamps();
    }
}
