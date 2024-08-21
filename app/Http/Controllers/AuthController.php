<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Obtener las credenciales proporcionadas por el usuario desde la solicitud
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario utilizando las credenciales proporcionadas
        if (!Auth::attempt($credentials)) {
            // Si las credenciales no son válidas, devolver una respuesta JSON con un mensaje de "No autorizado"
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Si la autenticación es exitosa, obtener el usuario autenticado
        $user = Auth::user();

        // Crear un nuevo token de autenticación para el usuario autenticado
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirigir al usuario a la página de favoritos
        return redirect('/favorites');
    }

    // Logout del usuario
    public function logout(Request $request)
    {
        // Elimina todos los tokens de acceso del usuario
        $request->user()->tokens()->delete();

        // Invalida la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirige al usuario a Characters
        return redirect('/')->with('message', 'You have been logged out successfully.');
    }


}
