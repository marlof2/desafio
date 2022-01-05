<?php

namespace Database\Seeders;

use App\Models\Acao;
use App\Models\Funcionalidade;
use App\Models\PerfilAcao;
use App\Models\UserFuncionalidadeAcao;
use App\Models\User;
use App\Models\Perfil;
use App\Models\UsuarioPerfil;
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
                'id_setor' => 1,
                'id_perfil' => 1,
                'name' => $faker->name(),
                'email' =>  $faker->unique()->safeEmail(),
                'cpf' => '03296244581',
                'login' => 'marlo',
                'password' => Hash::make('teste'),
                'ativo' => 1,
            ]
        );

        $usuarios->push($usuario);

//        $usuario = User::firstOrCreate(
//            [
//                "login" => "mayara",
//            ],
//            [
//                'id_setor' => 2,
//                'name' => $faker->name(),
//                'email' => $faker->unique()->safeEmail(),
//                'cpf' => '03296244581',
//                'login' => 'mayara',
//                'password' => Hash::make('teste'),
//                'ativo' => 1,
//            ]
//        );
//
//        $usuarios->push($usuario);


        $perfilGeral = Perfil::firstOrCreate(
            [
                "nome" => "Geral"
            ],
            [
                "descricao" => "Perfil de teste com todas as permissões"
            ]
        );

        $usuarios->each(function ($usuario) {

            $funcionalidades = Funcionalidade::get();

            $acoes = Acao::get();

            $funcionalidades->each(function ($funcionalide) use ($acoes, $usuario) {
                $acoes->each(function ($acao) use ($funcionalide, $usuario) {
                    UserFuncionalidadeAcao::updateOrCreate([
                        'id_usuario' => $usuario->id,
                        'id_funcionalidade' => $funcionalide->id,
                        'id_acao' => $acao->id
                    ]);

                });
            });
        });

    }
}
