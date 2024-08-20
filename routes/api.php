<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Quitar lo de arriba?
use App\Http\Controllers\FavoriteController;
// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
});


use App\Http\Controllers\AuthController;
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']); no se si se usa o no
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


use App\Http\Controllers\CharacterController;
Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{id}', [CharacterController::class, 'show']);


