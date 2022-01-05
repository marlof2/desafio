<?php

namespace App\Http\Controllers;

use App\Models\Funcionalidade;
use Illuminate\Http\Request;

class FuncionalidadeController extends Controller
{
    public function getFuncionalidade()
    {

        try {
            $funcionalidades = Funcionalidade::all();

            return response()->json([
                'funcionalidades' => $funcionalidades
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
