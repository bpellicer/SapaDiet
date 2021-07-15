<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPreferit extends Model
{
    use HasFactory;

    public function planificacio(){
        return $this->belongsToMany(Planificacio::class);
    }
}
