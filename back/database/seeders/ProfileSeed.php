<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create(
            [
                'name' => 'Admin',
                'description' => 'Perfil de Administrador'
            ]
        );

        Profile::create(
            [
                'name' => 'Cliente',
                'description' => 'Perfil de Cliente'
            ]
        );
    }
}
