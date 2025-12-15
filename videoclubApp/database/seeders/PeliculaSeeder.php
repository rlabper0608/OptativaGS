<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelicula;
use App\Services\TmdbService; // Importar el servicio TMDb
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Necesario para Http::get()

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CORRECCIÓN CLAVE: Resolvemos el servicio TMDb directamente aquí
        $tmdbService = app(TmdbService::class);
        
        $peliculasData = [
            [
                'titulo' => 'Blade Runner 2049',
                'director' => 'Denis Villeneuve',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '2017-10-06',
                'duracion' => 164,
                'clasificacion' => '+16',
                'actores' => 'Ryan Gosling, Harrison Ford, Ana de Armas',
            ],
            [
                'titulo' => 'Parásitos',
                'director' => 'Bong Joon-ho',
                'genero' => 'Thriller Social',
                'fecha_estreno' => '2019-10-25',
                'duracion' => 132,
                'clasificacion' => '+16',
                'actores' => 'Song Kang-ho, Choi Woo-shik, Park So-dam',
            ],
            [
                'titulo' => 'Dune',
                'director' => 'Denis Villeneuve',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '2021-10-22',
                'duracion' => 155,
                'clasificacion' => '+12',
                'actores' => 'Timothée Chalamet, Rebecca Ferguson, Zendaya',
            ],
            [
                'titulo' => 'Origen',
                'director' => 'Christopher Nolan',
                'genero' => 'Thriller',
                'fecha_estreno' => '2010-08-06',
                'duracion' => 148,
                'clasificacion' => '+12',
                'actores' => 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page',
            ],
        ];

        // MÉTODOLOGÍA CORREGIDA: Llamamos al método privado para crear cada película
        foreach ($peliculasData as $data) {
            $this->seedPeliculaWithTmdb($data, $tmdbService);
        }
    }

    /**
     * Crea una película, la guarda en DB y descarga su póster de TMDb.
     * Esta función contiene la lógica de descarga que el usuario quiere reutilizar.
     */
    private function seedPeliculaWithTmdb(array $data, TmdbService $tmdbService): void
    {
        // 1. Crear la película SIN portada
        $pelicula = Pelicula::create($data);
        
        // 2. Intentar buscar y descargar la portada de TMDb
        try {
            $searchResults = $tmdbService->searchMovie($data['titulo']);

            if (!empty($searchResults['results'])) {
                $bestMatch = $searchResults['results'][0];
                $posterPath = $bestMatch['poster_path'];

                if ($posterPath) {
                    // Obtener la URL completa de la imagen
                    $imageUrl = $tmdbService->getImageUrl($posterPath);

                    // Descargar el contenido binario de la imagen
                    $response = Http::get($imageUrl);

                    if ($response->successful()) {
                        $imageContents = $response->body();
                        // Guardar el archivo en storage/app/public/portadas/
                        $filename = 'portadas/' . $pelicula->id . '.jpg';
                        Storage::disk('public')->put($filename, $imageContents);

                        // 3. Actualizar la película con la ruta de la portada
                        $pelicula->portada = $filename;
                        $pelicula->save();
                        
                        $this->command->info("Portada descargada para: " . $data['titulo']);

                    } else {
                        $this->command->warn("Fallo al descargar la portada de TMDb para: " . $data['titulo'] . ". Código de estado: " . $response->status());
                    }
                }
            }
        } catch (\Exception $e) {
            $this->command->error("Error de TMDb/Descarga para {$data['titulo']}: " . $e->getMessage());
        }
    }
}