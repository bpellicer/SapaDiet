<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPropi extends Model
{
    use HasFactory;

    protected $table="aliment_propis";

    public function categoria(){
        return $this->hasOne(Categoria::class);
    }

    public function imatge(){
        return $this->hasOne(Imatge::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
