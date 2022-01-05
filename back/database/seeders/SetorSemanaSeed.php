<?php

namespace Database\Seeders;

use App\Models\SetorSemana;
use Illuminate\Database\Seeder;

class SetorSemanaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetorSemana::create(
            [
                'id_setor' => 1,
                'id_semana' => 1,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' => 1,
                'id_semana' => 2,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' => 1,
                'id_semana' => 3,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' => 1,
                'id_semana' => 4,
            ]
        );
//        setor 2 daqui pra baixo
        SetorSemana::create(
            [
                'id_setor' => 2,
                'id_semana' => 5,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' =>2,
                'id_semana' => 6,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' => 2,
                'id_semana' => 7,
            ]
        );

        SetorSemana::create(
            [
                'id_setor' => 2,
                'id_semana' => 8,
            ]
        );
    }
}
