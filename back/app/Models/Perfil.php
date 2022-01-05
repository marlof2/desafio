<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];
    protected $table = 'perfil';
    protected $primaryKey = 'id';




    public function usuarioPerfil()
    {
        return $this->hasMany(UsuarioPerfil::class, 'id_perfil', 'id');
    }

//    public function usuario()
//    {
//        return $this->belongsToMany(User::class, 'usuario_perfil', 'id_usuario', 'id_perfil');
//    }

    public function funcionalidade()
    {
        return $this->belongsToMany(Funcionalidade::class, 'perfil_funcionalidade_acao', 'id_perfil', 'id_funcionalidade')
            ->select(
                'funcionalidade.id',
                'funcionalidade.nome_funcionalidade',
                'funcionalidade.descricao',
            )->groupBy(
                'funcionalidade.id',
                'funcionalidade.nome_funcionalidade',
                'funcionalidade.descricao',
                'perfil_funcionalidade_acao.id_perfil',
                'perfil_funcionalidade_acao.id_funcionalidade'
            );
    }

    public function UserPerfilFuncionalidadeAcao()
    {
        return $this->hasMany(UserFuncionalidadeAcao::class, 'id_perfil', 'id', );
    }

    public function acao()
    {
        return $this->belongsToMany(Acao::class, 'perfil_funcionalidade_acao', 'id_perfil', 'id_acao');
    }
}
