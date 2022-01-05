<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_setor',
        'id_perfil',
        'cpf',
        'login',
        'ativo',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function perfil()
    {
        return $this->belongsToMany(Perfil::class, 'usuario_perfil', 'id_usuario', 'id_perfil')
            ->select('perfil.id', 'perfil.nome');

    }

    public function UserperfilFuncionalidadeAcao()
    {
        return $this->hasMany(UserFuncionalidadeAcao::class, 'id_usuario', 'id');
//            ->select("UserFuncionalidadeAcao.id_funcionalidade", "UserFuncionalidadeAcao.id_acao");
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'id_setor', 'id');
    }

}
