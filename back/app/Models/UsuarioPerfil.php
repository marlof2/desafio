<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPerfil extends Model
{
    use HasFactory;
    protected $table = 'usuario_perfil';
    protected $fillable = ['id_usuario', 'id_perfil'];


    public function perfilFuncionalidadeAcao()
    {
        return $this->hasMany(PerfilFuncionalidadeAcao::class, 'id_perfil', 'id', );
    }

}
