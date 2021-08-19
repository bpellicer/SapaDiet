<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApat extends Model
{
    use HasFactory;

    public $increment = true;

    protected $table = "users_apats";

    protected $fillable = [
        'user_id',
        'apat_id'
    ];

    public function aliment(){
        return $this->belongsToMany(Aliment::class,'users_apats_aliments')->using(UserApatAliment::class)->withPivot('data','mesura_quantitat')->withTimestamps();
    }

    public function alimentPropi(){
        return $this->belongsToMany(AlimentPropi::class,'users_apats_aliments_propis')->using(UserApatAlimentPropi::class)->withPivot('data','mesura_quantitat')->withTimestamps();
    }

}
