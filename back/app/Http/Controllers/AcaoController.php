<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use Illuminate\Http\Request;

class AcaoController extends Controller
{
    public function getAcoes()
    {

        try {
            $acoes = Acao::all();

            return response()->json([
                'acoes' => $acoes
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
