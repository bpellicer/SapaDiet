<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificacio extends Model
{
    use HasFactory;

    protected $table = 'planificacions';

    public function user(){
        return $this->hasOne(User::class);
    }

    public function alimentpreferit(){
        return $this->belongsToMany(AlimentPreferit::class);
    }
}
