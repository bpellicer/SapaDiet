<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPropi extends Model
{
    use HasFactory;

    protected $table="aliment_propis";

    protected $fillable = [
        'nom',
        'categoria',
        'proteines',
        'greixos',
        'hidrats',
        'kilocalories'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userApat(){
        return $this->belongsToMany(UserApat::class)->using(UserApatAlimentPropi::class)->withTimestamps();
    }

}
