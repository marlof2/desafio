<?php

namespace Database\Factories;

use App\Models\Semana;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemanaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Semana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Semana::create(
            [
                'id' => 1,
                'nome' => 'Garibaldi',
            ]
        );
        Semana::create(
            [
                'id' => 2,
                'nome' => 'Cidadela',
            ]
        );
        Semana::create(
            [
                'id' => 3,
                'nome' => 'Itaigara',
            ]
        );
        Semana::create(
            [
                'id' => 4,
                'nome' => 'Pituba',
            ]
        );
    }
}
