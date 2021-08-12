<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apat extends Model
{
    use HasFactory;

    protected $table = "apats";

    protected $fillable = [
        'nom'
    ];

    public function user(){
        return $this->belongsToMany(User::class)->using(UserApat::class)->withTimestamps();
    }
}
