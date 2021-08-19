<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserApatAliment extends Pivot
{
    use HasFactory;

    public $increment = true;

    protected $table = "users_apats_aliments";

    protected $fillable = [
        'user_apat_id',
        'aliment_id',
        'mesura_quantitat',
        'data'
    ];
}
