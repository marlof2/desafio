<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Faker\Factory;
//use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');

        Cliente::Create(
            [
                'nome' => 'Marlo',
                'email' => $faker->email,
                'cpf' => $faker->cpf,
                'telefone' => '71-991717209',
                'endereco' => 'Rua A',
            ]
        );

        Cliente::Create(
            [
                'nome' => 'Atila',
                'email' => $faker->email,
                'cpf' => $faker->cpf,
                'telefone' => '71-991717209',
                'endereco' => 'Rua B',
            ]
        );

        Cliente::Create(
            [
                'nome' => 'Mayara',
                'email' => $faker->email,
                'cpf' => $faker->cpf,
                'telefone' => '71-991717209',
                'endereco' => 'Rua C',
            ]
        );

    }
}
