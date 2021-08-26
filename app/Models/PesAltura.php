<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesAltura extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table="pesos_altures";

    /**
     * Funció que assigna una relació N:1 amb la classe User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
