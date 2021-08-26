<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /** Taula de la BDD **/
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

    /**
     * Getter de la contrasenya de l'Usuari
     */
    public function getAuthPassword()
    {
        return $this->contrasenya;
    }
    /**
     * Setter de la contrasenya de l'Usuari hashejada amb la funció bcrypt
     * @param String $contrasenya       Conté la contrasenya de l'Usuari sense hash
     */
    public function setContrasenyaAttribute($contrasenya){
        $this->attributes['contrasenya'] = bcrypt($contrasenya);
    }

    /**
     * Setter del nom de l'Usuari amb la primera lletra en majúsucla
     * @param String $nom       Conté el nom de l'Usuari
     */
    public function setNomAttribute($nom){
        $this->attributes['nom'] = ucfirst($nom);
    }

    /**
     * Getter del nom de l'Usuari
     * @param String $nom       Conté el nom
     */
    public function getNomAttribute($nom){
        return $nom;
    }
    /**
     * Setter dels cognoms de l'Usuari amb cada cognom amb la primera lletra majúscula
     * @param String $cognoms       Conté els cognoms de l'Usuari
     */
    public function setCognomsAttribute($cognoms){
        $this->attributes['cognoms'] = ucwords($cognoms);
    }

    /**
     * Getter dels cognoms de l'Usuari
     * @param String $cognoms   Conté els cognoms
     */
    public function getCognomsAttribute($cognoms){
        return $cognoms;
    }

    /**
     * Funció que assigna una relació 1:1 amb la classe Imatge
     */
    public function imatge(){
        return $this->belongsTo(Imatge::class);
    }

    /**
     * Funció que assigna una relació 1:1 amb la classe Planificació
     */
    public function planificacio(){
        return $this->belongsTo(Planificacio::class);
    }

    /**
     * Funció que esborra la Planificació de l'Usuari sempre que aquesta no tingui id = 1, és a dir, la per defecte.
     */
    public function deletePlanificacio(){
        if($this->planificacio_id != 1){
            $this->planificacio()->delete();
        }
    }

    /**
     * Funció que assigna una relació 1:N amb la classe AlimentPropi
     */
    public function alimentpropi(){
        return $this->hasMany(AlimentPropi::class);
    }

    /**
     * Funció que assigna una relació N:M amb la classe Apat fent servir la classe UserApat com a classe pivot
     */
    public function apat(){
        return $this->belongsToMany(Apat::class,'users_apats')->using(UserApat::class)->withTimestamps();
    }

    /**
     * Funció que assigna una relació 1:N amb la classe PesAltura
     */
    public function pesAltura(){
        return $this->hasMany(PesAltura::class);
    }

    /**
     * Funció que assigna una relació 1:N amb la classe LlistaCompra
     */
    public function llistaCompra(){
        return $this->hasMany(LlistaCompra::class);
    }
}
