<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'create']);
    Route::get('/', [UserController::class, 'getAll']);
    Route::get('/{id}', [UserController::class, 'getById']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

