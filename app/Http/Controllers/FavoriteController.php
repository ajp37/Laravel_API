<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Http;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        // Validar que se recibe el character_id
        $request->validate([
            'character_id' => 'required|integer',
        ]);

        $characterId = $request->input('character_id');

        // Hacer la solicitud a la API de Rick & Morty para obtener detalles del personaje
        $response = Http::get("https://rickandmortyapi.com/api/character/{$characterId}");

        if ($response->failed()) {
            return response()->json(['message' => 'Character not found in Rick & Morty API'], 404);
        }

        // Obtener el usuario autenticado
        $user = $request->user();

        // Verificar si el personaje ya está en los favoritos del usuario
        if ($user->favorites()->where('character_id', $characterId)->exists()) {
            return response()->json(['message' => 'Character already in favorites'], 409);
        }

        // Guardar el personaje en favoritos
        $favorite = new Favorite([
            'user_id' => $user->id,
            'character_id' => $characterId,
        ]);
        $favorite->save();

        return response()->json($favorite, 201);
    }


    public function index(Request $request)
    {
        $user = $request->user();
        $favorites = $user->favorites()->get();

        // Para cada favorito, obtenemos los detalles del personaje
        $favoritesWithDetails = $favorites->map(function ($favorite) {
            $response = Http::get("https://rickandmortyapi.com/api/character/{$favorite->character_id}");
            return $response->json();
        });

        return view('favorites.index', ['favorites' => $favoritesWithDetails]);
    }


    public function destroy($id, Request $request)
    {
        // Obtener el usuario autenticado
        $user = $request->user();

        // Buscar el favorito en la base de datos usando el character_id
        $favorite = $user->favorites()->where('character_id', $id)->first();

        // Verificar si el personaje existe en los favoritos del usuario
        if (!$favorite) {
            return response()->json(['message' => 'Character not found in favorites'], 404);
        }

        // Eliminar el favorito
        $favorite->delete();
        return response()->json(['message' => 'Character removed from favorites'], 200);
    }



}
