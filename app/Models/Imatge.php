<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imatge extends Model
{
    use HasFactory;

    protected $table = 'imatges';

    public function user(){
        return $this->hasMany(User::class);
    }

    public function categoria(){
        return $this->hasOne(Categoria::class);
    }
}
