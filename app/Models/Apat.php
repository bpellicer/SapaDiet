<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apat extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = "apats";

    /** Atribut que pot ser mass assigned () **/
    protected $fillable = [
        'nom'
    ];

    /**
     * Funció que assigna una relació N:M amb la classe User fent servir la classe UserApat com a classe pivot
     */
    public function user(){
        return $this->belongsToMany(User::class)->using(UserApat::class)->withTimestamps();
    }
}
