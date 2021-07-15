<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'cognoms',
        'email',
        'contrasenya'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contrasenya',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    public function setContrasenyaAttribute($contrasenya){
        $this->attributes['contrasenya'] = bcrypt($contrasenya);
    }

    public function setNomAttribute($nom){
        $this->attributes['nom'] = ucfirst($nom);
    }

    public function getNomAttribute($nom){
        return $nom;
    }

    public function setCognomsAttribute($cognoms){
        $this->attributes['cognoms'] = ucwords($cognoms);
    }

    public function getCognomsAttribute($cognoms){
        return $cognoms;
    }

    public function imatge(){
        return $this->belongsTo(Imatge::class);
    }

    public function planifiacio(){
        return $this->belongsTo(Planificacio::class);
    }

}
