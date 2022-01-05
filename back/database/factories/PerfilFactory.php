<?php

namespace Database\Factories;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Perfil::create(
            [
                'nome' => 'Geral',
                'descricao' => 'Perfil de teste com todas as permissões'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Usuario',
                'descricao' => 'Perfil de Usuario'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Admi',
                'descricao' => 'Perfil de representante'
            ]
        );

        Perfil::create(
            [
                'nome' => 'Gestor',
                'descricao' => 'Perfil de gestor'
            ]
        );
    }
}
