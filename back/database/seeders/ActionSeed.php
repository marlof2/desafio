<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create(
            [
                'name' => 'Criar',
                'description' => 'Ação de Criar'
            ]
        );

        Action::create(
            [
                'name' => 'Editar',
                'description' => 'Ação de Editar'
            ]
        );

        Action::create(
            [
                'name' => 'Deletar',
                'description' => 'Ação de Deletar'
            ]
        );

        Action::create(
            [
                'name' => 'Consultar',
                'description' => 'Ação de Consultar'
            ]
        );
    }
}
