<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AcaoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionalidadeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', function () {
    return response()->json([
        'Api' => 'Ok'
    ]);
});
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => 'jwt'], function () {
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/auth/me', [AuthController::class, 'me'])->name('auth.me');

    Route::get('/perfil', [PerfilController::class, 'getPerfil'])->name('getPerfil');
    Route::get('/acao', [AcaoController::class, 'getAcoes'])->name('getAcoes');
    Route::get('/funcionalidade', [FuncionalidadeController::class, 'getFuncionalidade'])->name('getFuncionalidade');

    Route::prefix('/cliente')->group(function () {
        Route::get('/index', [ClienteController::class, 'index'])->name('cliente.index');
        Route::get('/clientById/{id}', [ClienteController::class, 'ClienteById'])->name('getCliente');
        Route::post('/store', [ClienteController::class, 'store'])->name('cliente.store');
        Route::put('/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
        Route::delete('/delete/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/listAllUser', [UserController::class, 'listAllUser'])->name('users.index');
        Route::post('/adicionar', [UserController::class, 'adicionar'])->name('users.adicioanar');
        Route::get('/getUser/{id}', [UserController::class, 'getUser'])->name('users.getUser');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

});
