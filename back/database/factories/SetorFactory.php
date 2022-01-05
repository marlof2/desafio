<?php

namespace Database\Factories;

use App\Models\Semana;
use App\Models\Setor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Setor::create(
            [
                'id' => 1,
                'codigo_setor' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Itaigara',
                'ativo' => 1,
            ]
        );

        Setor::create(
            [
                'id' => 2,
                'codigo_setor' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Barra',
                'ativo' => 1,
            ]
        );

    }
}
