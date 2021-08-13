<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesAltura extends Model
{
    use HasFactory;

    protected $table="pesos_altures";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
