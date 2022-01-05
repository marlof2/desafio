<?php

namespace Database\Seeders;

use App\Models\Acao;
use Illuminate\Database\Seeder;

class AcaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Acao::create(
            [
                'nome' => 'Criar',
                'descricao' => 'Ação de Criar'
            ]
        );

        Acao::create(
            [
                'nome' => 'Editar',
                'descricao' => 'Ação de Editar'
            ]
        );

        Acao::create(
            [
                'nome' => 'Deletar',
                'descricao' => 'Ação de Deletar'
            ]
        );

        Acao::create(
            [
                'nome' => 'Consultar',
                'descricao' => 'Ação de Consultar'
            ]
        );
    }
}
