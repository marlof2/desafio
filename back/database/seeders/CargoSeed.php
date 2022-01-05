<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CargoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Cargo::create(
            [
                'codigo_cargo' => $faker->numberBetween(1, 9999),
                'nome' => 'Diretor',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $faker->numberBetween(1, 9999),
                'nome' => 'Gestor',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $faker->numberBetween(1, 9999),
                'nome' => 'Comercial',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $faker->numberBetween(1, 9999),
                'nome' => 'Vendas',
                'ativo' => 1,
            ]
        );

        Cargo::create(
            [
                'codigo_cargo' => $faker->numberBetween(1, 9999),
                'nome' => 'Colaborador',
                'ativo' => 1,
            ]
        );
    }
}
