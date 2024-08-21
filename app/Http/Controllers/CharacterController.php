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
        // Página actual (default: 1)
        $page = $request->input('page', 1);

        // Obtener los filtros de la solicitud
        $query = $request->input('query', ''); // Filtro por nombre
        $status = $request->input('status', ''); // Filtro por estado
        $species = $request->input('species', ''); // Filtro por especie
        $gender = $request->input('gender', ''); // Filtro por género

        // Construir la URL con los filtros y la paginación
        $url = "https://rickandmortyapi.com/api/character?page={$page}&name={$query}&status={$status}&species={$species}&gender={$gender}";

        $response = Http::get($url);

        // Verificar si la solicitud falló
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

        // Retornar una vista con los datos de los personajes
        return view('characters.index', [
            'characters' => $data['results'],
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
            ],
            // Pasar los filtros actuales a la vista para mantener los valores en el formulario
            'filters' => compact('query', 'status', 'species', 'gender'),
        ]);
    }


    // Obtener detalle de un personaje por ID
    public function show($id)
    {
        // Llamada a la API de Rick & Morty
        $response = Http::get("https://rickandmortyapi.com/api/character/{$id}");

        // Verificar si la respuesta falló
        if ($response->failed()) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        // Obtener los datos del personaje
        $character = $response->json();

        // Retornar una vista con los datos del personaje
        return view('characters.show', compact('character'));
    }

}








