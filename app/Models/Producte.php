<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    /** Taula BDD **/
    protected $table = "productes";

    /**
     * Funció que assigna una relació N:1 amb la classe LlistaCompra
     */
    public function llistaCompra(){
        return $this->belongsTo(LlistaCompra::class);
    }
}
