<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed', // 'password_confirmation' en el formulario
    ]);

    // Crear el nuevo usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Autenticar al usuario automáticamente después del registro
    Auth::login($user);

    // Crear el token de autenticación
    $token = $user->createToken('auth_token')->plainTextToken;

    // Redirigir al usuario
    return redirect('/favorites')->with('auth_token', $token);
}


    // Login de usuario
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        //return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
        return redirect('/favorites');
    }

    // Logout del usuario (opcional) NO USADO EN VISTAS DE MOMENTO
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
