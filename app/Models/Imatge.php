<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imatge extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = 'imatges';

    /**
     * Funció que assigna una relació 1:N amb la classe User
     */
    public function user(){
        return $this->hasMany(User::class);
    }
    /**
     * Funció que assigna una relació 1:1 amb la classe Categoria
     */
    public function categoria(){
        return $this->hasOne(Categoria::class);
    }
}
