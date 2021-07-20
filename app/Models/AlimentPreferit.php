<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentPreferit extends Model
{
    use HasFactory;

    protected $table = 'aliments_preferits';

    public function planificacio(){
        return $this->belongsToMany(Planificacio::class,'aliment_preferit_planificacio')->withTimestamps();
    }
}
