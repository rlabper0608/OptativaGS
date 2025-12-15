<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
// Usaremos los Requests para asegurar la validación
use App\Http\Requests\PeliculaCreateRequest;
use App\Http\Requests\PeliculaEditRequest;
use App\Services\TmdbService;

class PeliculaApiController extends Controller
{
    /**
     * Muestra una lista de todos los recursos (Películas) con Paginación.
     * GET /api/peliculas?page=N&limit=M
     */
    public function index(Request $request): JsonResponse
    {
        // Definir el número de elementos por página (default 15)
        // Permite que el usuario pase un parámetro 'limit' opcional
        $limit = $request->input('limit', 15);

        // Obtener las películas usando la paginación de Laravel
        $peliculas = Pelicula::orderBy('titulo')->paginate($limit);

        // Laravel's paginate() devuelve un objeto que ya incluye metadatos (links, total, página actual, etc.)
        // Al devolverlo como JSON, Laravel lo formatea automáticamente de forma estándar.

        return response()->json([
            'success' => true,
            // NOTA CLAVE: Devolvemos directamente el objeto de paginación para incluir metadatos.
            'data' => $peliculas
        ], 200);
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     * POST /api/peliculas
     */
    public function store(PeliculaCreateRequest $request, TmdbService $tmdbService): JsonResponse
    {
        try {
            // La validación se maneja automáticamente por PeliculaCreateRequest
            $validatedData = $request->validated();
            $pelicula = new Pelicula($validatedData);
            $result = false;
            $txtmessage = "";
            
            $bestMatch = null; 

            // Lógica para buscar datos de TMDb (solo si no se subió una portada manual)
            if (!$request->hasFile('portada')) {
                $searchResults = $tmdbService->searchMovie($request->titulo);

                if (!empty($searchResults['results'])) {
                    $bestMatch = $searchResults['results'][0];
                }
            }
            
            // Guardamos primero la película para obtener el ID, necesario para nombrar la imagen
            $result = $pelicula->save(); 
            
            // --- LÓGICA DE SUBIDA DE IMAGEN ---

            // Si hay subida local, se sube y se guarda
            if($request->hasFile('portada')) {
                // Asumiendo que esta es la versión API del uploadPortada
                $ruta = $request->file('portada')->store('portadas', 'public');
                $pelicula->portada = $ruta;
                $pelicula->save();
            } 
            // Si NO hay subida local, pero encontramos póster en TMDb, lo descargamos
            else if ($bestMatch && $bestMatch['poster_path']) {
                
                $imageUrl = $tmdbService->getImageUrl($bestMatch['poster_path']);
                
                $response = Http::get($imageUrl);

                if ($response->successful()) {
                    $imageContents = $response->body();
                    $filename = 'portadas/' . $pelicula->id . '.jpg';
                    
                    Storage::disk('public')->put($filename, $imageContents);
                    
                    $pelicula->portada = $filename;
                    $pelicula->save(); 
                } 
            }
            // ----------------------------------

            return response()->json([
                'success' => true,
                'message' => 'Película creada exitosamente.',
                'data' => $pelicula
            ], 201); // 201 Created
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la película.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Muestra un recurso específico.
     * GET /api/peliculas/{pelicula}
     */
    public function show(Pelicula $pelicula): JsonResponse
    {
        // El Route Model Binding ya cargó la película
        return response()->json([
            'success' => true,
            'data' => $pelicula
        ], 200);
    }

    /**
     * Actualiza un recurso específico en el almacenamiento.
     * PUT/PATCH /api/peliculas/{pelicula}
     */
    public function update(PeliculaEditRequest $request, Pelicula $pelicula): JsonResponse
    {
        try {
            // Lógica para manejar la eliminación de portada si es solicitada (no incluida en el request original, pero necesaria)
            
            // Actualiza la película con los datos validados
            $pelicula->fill($request->validated());
            $pelicula->save();

            // Lógica para manejar la subida/reemplazo de imagen
             if($request->hasFile('portada')) {
                // 1. Eliminar la portada antigua
                if ($pelicula->portada) {
                    Storage::disk('public')->delete($pelicula->portada);
                }
                // 2. Subir nueva portada y actualizar el modelo
                $ruta = $request->file('portada')->store('portadas', 'public');
                $pelicula->portada = $ruta;
                $pelicula->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Película actualizada exitosamente.',
                'data' => $pelicula
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la película.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina un recurso específico del almacenamiento.
     * DELETE /api/peliculas/{pelicula}
     */
    public function destroy(Pelicula $pelicula): JsonResponse
    {
        try {
            // 1. Eliminar la portada del storage
            if ($pelicula->portada) {
                Storage::disk('public')->delete($pelicula->portada);
            }
            
            $pelicula->delete();

            return response()->json([
                'success' => true,
                'message' => 'Película eliminada exitosamente.'
            ], 204); // 204 No Content (Éxito sin devolver cuerpo)
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la película.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}