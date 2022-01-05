<?php

namespace Database\Factories;

use App\Models\SetorSemana;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetorSemanaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SetorSemana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        SetorSemana::create(
            [
                'id' => 1,
                'id_setor' => 1,
                'id_semana' => 1,
            ]
        );

        SetorSemana::create(
            [
                'id' => 2,
                'id_setor' => 1,
                'id_semana' => 2,
            ]
        );

        SetorSemana::create(
            [
                'id' => 3,
                'id_setor' => 1,
                'id_semana' => 3,
            ]
        );

        SetorSemana::create(
            [
                'id' => 4,
                'id_setor' => 1,
                'id_semana' => 4,
            ]
        );
    }
}
