<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


//añadido por mi
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FavoriteController;

// Ruta para la página de inicio (registro)
Route::get('/', function () {
    return view('auth.register');
});

// Ruta para el formulario de inicio de sesión
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');




Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', function () {
    return view('auth.login');
});


Route::post('/login', [AuthController::class, 'login']);




// Ruta para mostrar el listado de personajes
Route::get('/characters', [CharacterController::class, 'index']);

// Ruta para mostrar el detalle de un personaje
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('characters.show');
// he quitado la (/...s)

// Ruta para mostrar los favoritos
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');

// Ruta para agregar un personaje a favoritos
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store')->middleware('auth');

// Ruta para eliminar un personaje de favoritos
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy')->middleware('auth');
