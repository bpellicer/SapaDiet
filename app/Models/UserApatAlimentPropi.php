<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApatAlimentPropi extends Model
{
    use HasFactory;

    protected $table = "users_apats_aliments_propis";

    public $increment = true;

    protected $fillable = [
        'user_apat_id',
        'aliment_propi_id',
        'mesura_quantitat',
        'data'
    ];
}
