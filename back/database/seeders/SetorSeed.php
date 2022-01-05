<?php

namespace Database\Seeders;

use App\Models\Setor;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SetorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Setor::create(
            [
                'codigo_setor' => $faker->numberBetween(1, 9999),
                'nome' => 'Itaigara',
                'ativo' => 1,
            ]
        );

        Setor::create(
            [
                'codigo_setor' => $faker->numberBetween(1, 9999),
                'nome' => 'Barra',
                'ativo' => 1,
            ]
        );
    }
}
