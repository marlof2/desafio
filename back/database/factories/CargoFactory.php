<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cargo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        Cargo::create(
            [
                'codigo_cargo' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Diretor',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Gestor',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Comercial',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Vendas',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $this->faker->numberBetween(1, 9999),
                'nome' => 'Colaborador',
                'ativo' => 1,
            ]
        );

    }
}
