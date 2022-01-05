<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function getPerfil()
    {

        try {
            $perfis = Perfil::all();

            return response()->json([
                'perfis' => $perfis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'msg' => $e->getLine(),
                'erro' => $e->getMessage(),
            ], 422);
        }
    }
}
