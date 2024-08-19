<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterController extends Controller
{
    // Obtener listado de personajes
    public function index()
    {
        // Llamada a la API de Rick & Morty
        $response = Http::get('https://rickandmortyapi.com/api/character');

        if ($response->failed()) {
            return response()->json(['message' => 'Failed to fetch characters'], 500);
        }

        return response()->json($response->json(), 200);
    }

    // Obtener detalle de un personaje por ID
    public function show($id)
    {
        // Llamada a la API de Rick & Morty
        $response = Http::get("https://rickandmortyapi.com/api/character/{$id}");

        if ($response->failed()) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        return response()->json($response->json(), 200);
    }
}








