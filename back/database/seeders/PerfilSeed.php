<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create(
            [
                'nome' => 'Geral',
                'descricao' => 'Perfil de teste com todas as permissões'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Usuario',
                'descricao' => 'Perfil de Usuario'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Representante',
                'descricao' => 'Perfil de representante'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Gestor',
                'descricao' => 'Perfil de gestor'
            ]
        );
    }
}
