<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function register(Request $request)
    {

        try {

//            $filterEmpty = $this->user->filterEmpty($request->all());
//            if ($filterEmpty){
//                return $filterEmpty;
//                return response()->json([$filterEmpty]);
//            }

            $save = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'estado_civil' => $request->estado_civil,
                'profissao' => $request->profissao,
            ];


            $user = User::create($save);

            return response()->json([
                'success' => 'Criado com sucesso!',
                'user' => $user
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e,
            ]);

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

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1000,
            'success' => 'Logado com sucesso!'
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'estado_civil' => $request->estado_civil,
                'profissao' => $request->profissao,
            ]);

        return response()->json(['msg' => 'Alterado com Sucesso']);
    }
}
