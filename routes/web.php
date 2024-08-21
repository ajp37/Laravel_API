<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FavoriteController;

require __DIR__.'/auth.php';


// Ruta para la página de inicio (Characters)
Route::get('/', [CharacterController::class, 'index']);

// Ruta para el registro
Route::get('/register', function () {
    return view('auth.register');
});
// Registrar usuario
Route::post('/register', [AuthController::class, 'register']);

// Ruta para el login
Route::get('/login', function () {
    return view('auth.login');
});
// Iniciar sesión
Route::post('/login', [AuthController::class, 'login']);

// Cierre de sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Ruta para mostrar el listado de personajes
Route::get('/characters', [CharacterController::class, 'index']);

// Ruta para mostrar el detalle de un personaje
Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show');
// he quitado la (/...s)

// Ruta para mostrar los favoritos
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');

// Ruta para agregar un personaje a favoritos
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store')->middleware('auth');

// Ruta para eliminar un personaje de favoritos
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy')->middleware('auth');
