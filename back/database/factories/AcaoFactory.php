<?php

namespace Database\Factories;

use App\Models\Acao;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Acao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        Acao::create(
            [
                'nome' => 'add.user',
                'descricao' => 'Adicionar um usuário'
            ]
        );

        Acao::create(
            [
                'nome' => 'edit.user',
                'descricao' => 'Alterar um usuário'
            ]
        );

        Acao::create(
            [
                'nome' => 'delete.user',
                'descricao' => 'Deletar um usuário'
            ]
        );

        Acao::create(
            [
                'nome' => 'view.user',
                'descricao' => 'Visualizar um usuário'
            ]
        );
    }
}
