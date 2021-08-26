<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserApatAliment extends Pivot
{
    use HasFactory;

    /** AutoIncrement true a la BDD **/
    public $increment = true;

    /** Taula de la BDD **/
    protected $table = "users_apats_aliments";

    /** Atributs mass assigned **/
    protected $fillable = [
        'user_apat_id',
        'aliment_id',
        'mesura_quantitat',
        'data'
    ];
}
