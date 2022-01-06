<?php

namespace Database\Seeders;

use App\Models\PerfilAcao;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $usuarios = collect([]);

        $usuario = User::firstOrCreate(
            [
                "login" => "marlo",
            ],
            [
                'id' => 1,
                'name' => $faker->name(),
                'email' =>  $faker->unique()->safeEmail(),
                'cpf' => '03296244581',
                'login' => 'marlo',
                'password' => Hash::make('teste'),
                'ativo' => 1,
            ]
        );

        $usuarios->push($usuario);

    }
}
