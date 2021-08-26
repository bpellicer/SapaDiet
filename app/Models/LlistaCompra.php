<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlistaCompra extends Model
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table ="llistes_compra";

    /**
     * Funció que assigna una relació N:1 amb la classe User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
