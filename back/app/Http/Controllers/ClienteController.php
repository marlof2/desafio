<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    /**
     * Método que retorna todos os clientes
     * @return array
     * @author Marlo Marques
     */
    public function index()
    {
        try {
            $cliente = Cliente::paginate(config('app.pageLimit'));
            return response()->json([
                'cliente' => $cliente
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getLine(),
                'erro' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Método que retorna apenas um cliente
     * @param $id int id do cliente para receber como parametro na consulta
     * @param Cliente $cliente model de cliente
     * @return array
     * @author Marlo Marques
     */
    public function show($id, Cliente $cliente)
    {
        try {
            return response()->json(['data' => $cliente->where('id', $id)->get()], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    /**
     * Método que faz a inserção de clientes
     * @param StoreUserRequest $request request personalisado para validar os dados
     * @param Cliente $cliente model de cliente
     * @return array
     * @author Marlo Marques
     */
    public function store(StoreUserRequest $request, Cliente $cliente)
    {
        try {
            return response()->json([
                'data' => $cliente->create($request->all()),
                'isSuccess' => 'true'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    /**
     * Método que faz a alteração de cliente
     * @param StoreUserRequest $request request personalisado para validar os dados
     * @param Cliente $cliente model de cliente
     * @return array
     * @author Marlo Marques
     */
    public function update(StoreUserRequest $request, Cliente $cliente)
    {
        try {
            return response()->json([
                'data' => $cliente->where('id', $request->id)->update($request->except('id')),
                'isSuccess' => 'true'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    /**
     * Método que deleta o cliente
     * @param StoreUserRequest $request request personalisado para validar os dados
     * @param Cliente $cliente model de cliente
     * @return array
     * @author Marlo Marques
     */
    public function destroy($id, Cliente $cliente)
    {
        try {
            return response()->json([
                'data' => $cliente->where('id', $id)->delete(),
                'isSuccess' => 'true'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }
}
