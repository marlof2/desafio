<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserFuncionalidadeAcao extends Model
{
    use HasFactory;
    protected $table = 'user_funcionalidade_acao';
    protected $fillable = ['id_funcionalidade', 'id_acao', 'id_usuario'];


//    public function perfil()
//    {
//        return $this->belongsTo(Perfil::class, 'id', 'id');
//    }
//    public function funcionalidade()
//    {
//        return $this->belongsTo(Funcionalidade::class);
//    }
//    public function acao()
//    {
//        return $this->belongsTo(Acao::class);
//    }
}
