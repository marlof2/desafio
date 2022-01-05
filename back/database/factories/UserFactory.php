<?php

namespace Database\Factories;

use App\Models\Acao;
use App\Models\Funcionalidade;
use App\Models\Perfil;
use App\Models\PerfilFuncionalidadeAcao;
use App\Models\User;
use App\Models\UsuarioPerfil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = collect([]);

        $usuario = User::firstOrCreate(
            [
                "login" => "marlo",
            ],
            [
                'id' => 1,
                'id_cargo' => 1,
                'id_perfil' => 1,
                'id_setor' => 4,
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'cpf' => '03296244581',
                'login' => 'marlo',
                'password' => Hash::make('teste'),
                'ativo' => 1,
            ]
        );

        $usuarios->push($usuario);

//        $usuario = User::firstOrCreate(
//            [
//                "login" => "marlo",
//            ],
//            [
//                'id_cargo' => 1,
//                'id_perfil' => 1,
//                'id_setor' => 1,
//                'name' => $this->faker->name(),
//                'email' => $this->faker->unique()->safeEmail(),
//                'cpf' => '03296244581',
//                'login' => 'marlo',
//                'password' => Hash::make('teste'),
//                'ativo' => 1,
//            ]
//        );
//
//        $usuarios->push($usuario);
//

        $perfilGeral = Perfil::firstOrCreate(
            [
                "nome" => "Geral"
            ],
            [
                "descricao" => "Perfil de teste com todas as permissões"
            ]
        );

        $usuarios->each(function ($usuario) use ($perfilGeral) {
            UsuarioPerfil::firstOrCreate([
                'id_usuario' => $usuario->id,
                'id_perfil' => $perfilGeral->id
            ]);
        });

        $funcionalidades = Funcionalidade::get();
        $acoes = Acao::get();

        $funcionalidades->each(function ($funcionalide) use ($acoes, $perfilGeral) {
            $acoes->each(function ($acao) use ($funcionalide, $perfilGeral) {
                PerfilFuncionalidadeAcao::updateOrCreate([
                    'id_perfil' => $perfilGeral->id,
                    'id_funcionalidade' => $funcionalide->id,
                    'id_acao' => $acao->id
                ]);
            });
        });
    }

}
