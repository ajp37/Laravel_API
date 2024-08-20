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



// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');// configurar(2) para que showloginform muestre cada vista
Route::get('/login', function () {
    return view('auth.login');
});


Route::post('/login', [AuthController::class, 'login']);




// Ruta para mostrar el listado de personajes
Route::get('/characters', [CharacterController::class, 'index'])->middleware('auth');

// Ruta para mostrar los favoritos
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');

