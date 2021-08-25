<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlistaCompra extends Model
{
    use HasFactory;

    protected $table ="llistes_compra";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
