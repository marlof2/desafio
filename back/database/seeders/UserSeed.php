<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\User;
use App\Models\UserAction;
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
                'id_profile' => 1,
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'login' => 'marlo',
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $usuarios->each(function ($usuario) {
            $actions = Action::get();
            $actions->each(function ($action) use ($usuario) {
                UserAction::create([
                    'id_action' => $action->id,
                    'id_user' => $usuario->id,
                ]);
            });
        });

    }
}
