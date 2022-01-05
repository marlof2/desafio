<?php

namespace Database\Factories;

use App\Models\Funcionalidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionalidadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Funcionalidade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Funcionalidade::create(
            [
                'nome_funcionalidade' => 'Usuario',
                'descricao' => 'view de usuario'
            ]
        );
    }
}
