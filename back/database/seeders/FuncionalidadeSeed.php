<?php

namespace Database\Seeders;

use App\Models\Funcionalidade;
use Illuminate\Database\Seeder;

class FuncionalidadeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Funcionalidade::firstOrCreate(
            [
                'nome_funcionalidade' => 'Usuário',
                'descricao' => 'view de usuario'
            ]
        );

        Funcionalidade::firstOrCreate(
            [
                'nome_funcionalidade' => 'Setor',
                'descricao' => 'view de Setor'
            ]
        );
        Funcionalidade::firstOrCreate(
            [
                'nome_funcionalidade' => 'Médico',
                'descricao' => 'view de Médico'
            ]
        );

        Funcionalidade::firstOrCreate(
            [
                'nome_funcionalidade' => 'Farmacia',
                'descricao' => 'view de Farmacia '
            ]
        );
    }
}
