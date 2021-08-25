<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'cognoms',
        'email',
        'contrasenya',
        'sexe',
        'edat'
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

    public function planificacio(){
        return $this->belongsTo(Planificacio::class);
    }

    public function deletePlanificacio(){
        if($this->planificacio_id != 1){
            $this->planificacio()->delete();
        }
    }

    public function alimentpropi(){
        return $this->hasMany(AlimentPropi::class);
    }

    public function apat(){
        return $this->belongsToMany(Apat::class,'users_apats')->using(UserApat::class)->withTimestamps();
    }

    public function pesAltura(){
        return $this->hasMany(PesAltura::class);
    }

    public function llistaCompra(){
        return $this->hasMany(LlistaCompra::class);
    }
}
