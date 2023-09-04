<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\api\TokenController;


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

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Route::get('add-user', [UserController::class, 'create'])->name('users.create');
    // Route::get('user-show/{user}', [UserController::class, 'show'])->name('users.show');
    // Route::post('user-save', [UserController::class, 'store'])->name('users.store');
    // Route::get('user-edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('user-update/{user}', [UserController::class, 'update'])->name('users.update');
    // Route::delete('user-delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::post('token', [TokenController::class, 'index'])->name('token.index');
    Route::post('token/create', [TokenController::class, 'create'])->name('token.create');
});


