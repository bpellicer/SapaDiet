<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApat extends Model
{
    use HasFactory;

    /** AutoIncrement de la BDD true **/
    public $increment = true;

    /** Taula de la BDD **/
    protected $table = "users_apats";

    /** Atributs que són mass assigned */
    protected $fillable = [
        'user_id',
        'apat_id'
    ];

    /**
     * Funció que assigna una relació N:M amb la classe Aliment fent servir la classe UserApatAliment com a classe pivot i amb els atributs data i mesura_quantitat
     */
    public function aliment(){
        return $this->belongsToMany(Aliment::class,'users_apats_aliments')->using(UserApatAliment::class)->withPivot('data','mesura_quantitat')->withTimestamps();
    }
    /**
     * Funció que assigna una relació N:M amb la classe AlimentPropi fent servir la classe UserApatAlimentPropi com a classe pivot i amb els atributs data i mesura_quantitat
     */
    public function alimentPropi(){
        return $this->belongsToMany(AlimentPropi::class,'users_apats_aliments_propis')->using(UserApatAlimentPropi::class)->withPivot('data','mesura_quantitat')->withTimestamps();
    }
}
