<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->hasOne(Categoria::class);
    }

    public function imatge(){
        return $this->hasOne(Imatge::class);
    }
}
