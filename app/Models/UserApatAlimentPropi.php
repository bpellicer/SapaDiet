<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserApatAlimentPropi extends Pivot
{
    use HasFactory;

    /** Taula de la BDD **/
    protected $table = "users_apats_aliments_propis";

    /** AutoIncrement true a la BDD **/
    public $increment = true;

    /** Atributs mass assigned **/
    protected $fillable = [
        'user_apat_id',
        'aliment_propi_id',
        'mesura_quantitat',
        'data'
    ];
}
