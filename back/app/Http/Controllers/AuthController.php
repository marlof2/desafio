<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Action;
use App\Models\Log;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['login', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Login ou Senha Invalida!']);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->all();
            $profileClient = Profile::where('id', 2)->get();
            $user['id_profile'] = $profileClient[0]['id'];
            $user['password'] = bcrypt($request->password);

            $userSaved = User::create($user);

            $actionEditAndConsult = Action::where('id', 2)->orWhere('id', 4)->get();

            foreach ($actionEditAndConsult as $actions) {
                UserAction::create([
                    'id_user' => $userSaved->id,
                    'id_action' => $actions->id,
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'msg' => 'Cadastro realizado com sucesso, faça login para iniciar a sua sessão !'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'error_linha' => $e->getLine(),
            ], 422);
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function addLogs()
    {
        $user = Auth::user();
        $arrayLogs = [
            'login' => $user->login,
            'name' => $user->name,
            'data/hora' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        Log::create($arrayLogs);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $this->addLogs();
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1000,
            'success' => 'Logado com sucesso!'
        ]);
    }

}
