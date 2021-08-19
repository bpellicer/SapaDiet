<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
    use HasFactory;

    protected $table="aliments";

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function userApat(){
        return $this->belongsToMany(UserApat::class)->using(UserApatAliment::class)->withTimestamps();
    }
}
