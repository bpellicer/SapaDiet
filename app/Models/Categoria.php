<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = 'categories';

    /**
     * Funció que assigna una relació 1:N amb la classe Aliment
     */
    public function aliment(){
        return $this->hasMany(Aliment::class);
    }

    /**
     * Funció que assigna una classe 1:1 amb la classe Imatge
     */
    public function imatge(){
        return $this->belongsTo(Imatge::class);
    }
}
