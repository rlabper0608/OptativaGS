<?php

namespace App\Services;

use App\Models\Pelicula;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PeliculaCreator
{
    protected $tmdbService;

    // Inyectamos tu servicio existente
    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    /**
     * Crea la película y gestiona la imagen (Manual o TMDb)
     */
    public function create(array $datos, ?UploadedFile $archivo = null): string
    {
        // 1. Crear la instancia inicial
        $pelicula = new Pelicula($datos);
        
        // 2. Lógica de búsqueda en TMDb (Si NO hay archivo manual)
        $bestMatch = null;
        if (!$archivo) {
            $searchResults = $this->tmdbService->searchMovie($datos['titulo']);
            if (!empty($searchResults['results'])) {
                $bestMatch = $searchResults['results'][0];
            }
        }

        // 3. Guardar para obtener el ID
        $pelicula->save();
        $mensaje = "La película se ha añadido correctamente.";

        // 4. Gestión de Portada
        if ($archivo) {
            // A: El usuario subió un archivo manual
            $nombreArchivo = $pelicula->id . '.' . $archivo->getClientOriginalExtension();
            // Guardamos en storage/app/public/portadas
            Storage::disk('public')->putFileAs('portadas', $archivo, $nombreArchivo);
            
            $pelicula->portada = 'portadas/' . $nombreArchivo;
            $pelicula->save();

        } elseif ($bestMatch && isset($bestMatch['poster_path'])) {
            // B: Descarga automática desde TMDb usando tu servicio
            $imageUrl = $this->tmdbService->getImageUrl($bestMatch['poster_path']);
            
            // Descargamos el contenido de la imagen
            $imageContents = Http::get($imageUrl)->body();
            
            $filename = 'portadas/' . $pelicula->id . '.jpg';
            
            Storage::disk('public')->put($filename, $imageContents);

            $pelicula->portada = $filename;
            $pelicula->save();
            
            $mensaje .= " (Portada descargada de TMDb)";
        }

        return $mensaje;
    }
}