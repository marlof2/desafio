<?php

namespace Database\Seeders;

use App\Models\Acao;
use App\Models\Cargo;
use App\Models\Funcionalidade;
use App\Models\Perfil;
use App\Models\Semana;
use App\Models\Setor;
use App\Models\SetorSemana;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AcaoSeed::class,
            FuncionalidadeSeed::class,
//            CargoSeed::class,
            PerfilSeed::class,
            SemanaSeed::class,
            SetorSeed::class,
            SetorSemanaSeed::class,
            UserSeed::class,

        ]);
    }
}
