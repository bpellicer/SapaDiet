<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function aliment(){
        return $this->hasMany(Aliment::class);
    }

    public function imatge(){
        return $this->belongsTo(Imatge::class);
    }
}
