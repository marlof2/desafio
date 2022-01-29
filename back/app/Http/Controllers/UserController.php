<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $per_page = $request->per_page;
            $search = $request->search;
            $query = User::query();
            $query->join('profile', 'id_profile', '=', 'profile.id')
                ->select('users.*', 'profile.name as profile_name');
            if ($search) {
                $query->where('profile.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.login', 'LIKE', '%' . $search . '%');
                $users = $query->paginate($per_page);
            } else {
                $users = $query->paginate($per_page);
            }
            return response()->json([$users], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }


    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->all();
            $user['password'] = bcrypt($request->password);

            $userSaved = User::create($user);

            foreach ($user['id_actions'] as $id_action) {
                UserAction::create([
                    'id_user' => $userSaved->id,
                    'id_action' => $id_action
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => 'true',
                'msg' => 'Cadastro realizado com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function show($id, User $user)
    {
        try {
            $data = $user->with('userAction')->find($id);

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function update(StoreUserRequest $request, User $user, $id)
    {
        try {
            DB::beginTransaction();
            $user->find($id)->update($request->except('id'));

            $userActions = UserAction::where('id_user', $id)->get();
            foreach ($userActions as $userAction) {
                UserAction::where('id_user', $userAction->id_user)->delete();
            }

            $id_actions = $request->id_actions;
            foreach ($id_actions as $id_action) {
                UserAction::create([
                    'id_user' => $id,
                    'id_action' => $id_action
                ]);
            }
            DB::commit();
            return response()->json([
                'msg' => 'Alterado com sucesso!',
                'success' => 'true'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }

    public function destroy($id, User $user)
    {

        try {
            DB::beginTransaction();
            $user->find($id)->delete();
            $userActions = UserAction::where('id_user', $id)->get();
            foreach ($userActions as $userAction) {
                UserAction::where('id_user', $userAction->id_user)->delete();
            }
            DB::commit();
            return response()->json([
                'success' => 'true'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }
}
