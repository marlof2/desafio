<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;
    protected $table = 'setor';

    protected $fillable = ['codigo_setor','nome', 'ativo'];

    public function setorSemana()
    {
        return $this->hasMany(SetorSemana::class, 'id_setor', 'id', );
    }

//    1 para n, 1 setor tem varias semanas e varias semanas tem 1 setor
    public function semana()
    {
        return $this->belongsToMany(Semana::class, 'setor_semana', 'id_setor', 'id_semana' );
    }

}
