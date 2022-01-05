<?php

namespace Database\Seeders;

use App\Models\Semana;
use Illuminate\Database\Seeder;

class SemanaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semana::create(
            [
                'nome' => 'Garibaldi',
            ]
        );
        Semana::create(
            [
                'nome' => 'Cidadela',
            ]
        );
        Semana::create(
            [
                'nome' => 'Itaigara',
            ]
        );
        Semana::create(
            [
                'nome' => 'Pituba',
            ]
        );
//        setor 2 daqui pra baixo
        Semana::create(
            [
                'nome' => 'Graça',
            ]
        );
        Semana::create(
            [
                'nome' => 'Ondina',
            ]
        );
        Semana::create(
            [
                'nome' => 'Brotas',
            ]
        );
        Semana::create(
            [
                'nome' => 'Federação',
            ]
        );
    }
}
