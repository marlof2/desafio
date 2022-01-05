<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetorRequest;
use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    public function index()
    {

        try {
            $setor = Setor::all();

            return response()->json([
                'setor' => $setor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'msg' => $e->getLine(),
                'erro' => $e->getMessage(),
            ], 422);
        }
    }

    public function getSetor($id)
    {
        try {

            $setor = Setor::where('id', $id)->get();
            return response()->json($setor);

        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }


    }

    public function store(StoreSetorRequest $request, Setor $setor)
    {
        try {

            $setor->create($request->all());

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

    public function update(StoreSetorRequest $request, Setor $setor)
    {
        try {

            $setor->where('id', $request->id)->update($request->except('id'));

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

    public function destroy($id, Setor $setor)
    {

        try {

            $setor->where('id', $id)->delete();

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
