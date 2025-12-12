<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbService
{
    protected $baseUrl = 'https://api.themoviedb.org/3/';
    protected $apiKey;
    protected $language = 'es-ES'; // O el idioma que prefieras

    public function __construct()
    {
        // Obtener la clave API de las variables de entorno (debes definirla en .env)
        $this->apiKey = env('TMDB_API_KEY'); 
    }

    /**
     * Busca películas por título.
     */
    public function searchMovie(string $title): array
    {
        $response = Http::get($this->baseUrl . 'search/movie', [
            'api_key' => $this->apiKey,
            'query' => $title,
            'language' => $this->language,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        // Devolver un array vacío o manejar el error
        return [];
    }
    
    /**
     * Obtiene la URL completa de la imagen.
     */
    public function getImageUrl(string $path, string $size = 'w500'): string
    {
        // Ejemplo de base URL de imágenes, que siempre es diferente al API base
        return "https://image.tmdb.org/t/p/{$size}/{$path}";
    }
}