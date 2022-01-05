<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acao extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    protected $table = 'acao';

    public function perfil()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_acao');
    }
}
