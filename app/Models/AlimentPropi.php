<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPropi extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table="aliment_propis";

    /** Atributs que poden ser mass assigned per a fer inserts a la BDD de forma ràpida **/
    protected $fillable = [
        'nom',
        'categoria',
        'proteines',
        'greixos',
        'hidrats',
        'kilocalories'
    ];

    /**
     * Funció que assigna una relació N:1 amb la classe Categoria
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Funció que assigna una relació N:1 amb la classe User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Funció que assigna una relació N:M amb la classe UserApat fent servir la classe UserApatAlimentPropi com a classe pivot
     */
    public function userApat(){
        return $this->belongsToMany(UserApat::class)->using(UserApatAlimentPropi::class)->withTimestamps();
    }

}
