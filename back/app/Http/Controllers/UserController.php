<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Acao;
use App\Models\Funcionalidade;
use App\Models\Perfil;
use App\Models\UserFuncionalidadeAcao;
use App\Models\Setor;
use App\Models\User;
use App\Models\UsuarioPerfil;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function listAllUser()
    {
        try {
            $users = User::with('perfil')->with('setor')->get();

            return response()->json([
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'msg' => $e->getLine(),
                'erro' => $e->getMessage(),
            ], 422);
        }
    }


    public function adicionar(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $request->except('id_perfil', 'id_acoes', 'id_funcionalidades', 'acoesDasFuncionalidade');
            $user['password'] = bcrypt($request->password);
            $acoesDaFuncionalidades = $request->acoesDaFuncionalidade;

            $userSaved = User::create($user);
            foreach ($request->id_perfil as $id_perfil) {
                UsuarioPerfil::create([
                    'id_usuario' => $userSaved->id,
                    'id_perfil' => $id_perfil
                ]);

                foreach ($acoesDaFuncionalidades as $acoesDaFuncionalidade) {
                    foreach ($acoesDaFuncionalidade["id_acao"] as $id_acao) {
                        UserFuncionalidadeAcao::create([
                            'id_usuario' => $userSaved->id,
                            'id_perfil' => $id_perfil,
                            'id_funcionalidade' => $acoesDaFuncionalidade["id_funcionalidade"],
                            'id_acao' => $id_acao,
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json([
                'status' => '200',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function getUser(Request $request, $id)
    {
        try {
            $user = User::find($id)->load('UserperfilFuncionalidadeAcao', 'perfil', 'setor');
            $user['senha'] = $user->password;
//            dd($user);
            return response()->json([
                'usuario' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
            ], 422);
        }
    }
}
