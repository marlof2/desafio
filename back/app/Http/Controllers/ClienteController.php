<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {

        try {
            $cliente = Cliente::all();

            return response()->json([
                'cliente' => $cliente
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'msg' => $e->getLine(),
                'erro' => $e->getMessage(),
            ], 422);
        }
    }

    public function ClienteById($id)
    {
        try {

            $cliente = Cliente::where('id', $id)->get();
            return response()->json($cliente);

        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }


    }

    public function store(StoreClienteRequest $request, Cliente $cliente)
    {
        try {

            $cliente->create($request->all());

            return response()->json([
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function update(StoreClienteRequest $request, Cliente $cliente)
    {
        try {

            $cliente->where('id', $request->id)->update($request->except('id'));

            return response()->json([
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function destroy($id, Cliente $cliente)
    {

        try {

            $cliente->where('id', $id)->delete();

            return response()->json([
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }
}
