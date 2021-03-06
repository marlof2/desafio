<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\LogController;
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

Route::get('/', function () {
    return response()->json([
        'Api' => 'Ok'
    ]);
});
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::group(['middleware' => 'jwt'], function () {

    Route::prefix('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
        Route::get('/userAuth', [AuthController::class, 'userAuth'])->name('userAuth');
    });

    Route::apiResource('actions', ActionController::class)->only('index');
    Route::apiResource('profiles', ProfileController::class)->only('index');
    Route::apiResource('logs', LogController::class)->only('index');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

});
