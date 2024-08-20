<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterController extends Controller
{
    // Obtener listado de personajes
    public function index(Request $request)
{
    // Número de personajes por página (esto solo afecta la vista, no la API)
    $perPage = 20; // La API devuelve 20 personajes por página

    // Página actual (default: 1)
    $page = $request->input('page', 1);
    $url = "https://rickandmortyapi.com/api/character?page={$page}";

    $response = Http::get($url);

    if ($response->failed()) {
        // Manejar errores de solicitud
        return view('characters.index', [
            'characters' => [],
            'pagination' => [
                'current_page' => 1,
                'total_pages' => 1,
            ],
        ]);
    }

    $data = $response->json();

    // Calcular total de páginas
    $totalPages = $data['info']['pages'];

    return view('characters.index', [
        'characters' => $data['results'],
        'pagination' => [
            'current_page' => $page,
            'total_pages' => $totalPages,
        ],
    ]);
}



    // Obtener detalle de un personaje por ID
    public function show($id)
    {
        // Llamada a la API de Rick & Morty
        $response = Http::get("https://rickandmortyapi.com/api/character/{$id}");

        if ($response->failed()) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        return response()->json($response->json(), 200);// sacar esto a datos de vista y mostrar
    }
}








