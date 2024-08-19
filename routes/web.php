<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


//añadido por mi
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;

// Ruta para la página de inicio (registro)
Route::get('/', function () {
    return view('auth.register');
});

// Ruta para el formulario de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para mostrar el listado de personajes
Route::get('/characters', [CharacterController::class, 'index'])->middleware('auth');

// Ruta para mostrar los favoritos
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');

