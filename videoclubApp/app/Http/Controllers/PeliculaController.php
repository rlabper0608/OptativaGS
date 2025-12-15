<?php

namespace App\Http\Controllers;


// Importamos el modelo y clases necesarias
use App\Models\Pelicula; 
use App\Services\TmdbService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PeliculaCreateRequest;    


class PeliculaController extends Controller {
    
    function index(): View {

        // Obtenemos todas las películas para visualizarlas
        $peliculas = Pelicula::all(); 
        return view('pelicula.index', ['peliculas' => $peliculas]);

    }

    
    function create(): View {
        
        // Devolvemos la vista create con el formulario
        return view('pelicula.create');
    }

    
    function store(PeliculaCreateRequest $request, TmdbService $tmdbService): RedirectResponse {
        
        $pelicula = new Pelicula($request->validated());
        $result = false;
        $txtmessage = "";
        
        $bestMatch = null; 

        if (!$request->hasFile('portada')) {
            $searchResults = $tmdbService->searchMovie($request->titulo);

            if (!empty($searchResults['results'])) {
                $bestMatch = $searchResults['results'][0];
            }
        }


        try {

            $result = $pelicula->save(); 
            $txtmessage = "La película se ha añadido correctamente.";


            if($request->hasFile('portada')) {
 
                $ruta = $this->uploadPortada($request, $pelicula);
                $pelicula->portada = $ruta;
                $pelicula->save();
            } 

            else if ($bestMatch && $bestMatch['poster_path']) {
                

                $imageUrl = $tmdbService->getImageUrl($bestMatch['poster_path']);
                

                $imageContents = \Illuminate\Support\Facades\Http::get($imageUrl)->body();
                

                $filename = 'portadas/' . $pelicula->id . '.jpg';
                

                \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageContents);

                $pelicula->portada = $filename;
                $pelicula->save(); 
                
                $txtmessage .= " (Portada de TMDb descargada y aplicada)";
            }
            
        } catch(\Illuminate\Database\UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe una película con esa información.";
        } catch(\Illuminate\Database\QueryException $e) {
            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";
        } catch (\Exception $e) {

            $txtmessage = "Error Fatal al guardar la película: " . $e->getMessage();
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if ($result){
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    private function uploadPortada(Request $request, Pelicula $pelicula): string {

        $portada = $request->file('portada');

        $name = $pelicula->id . "." . $portada->getClientOriginalExtension();

        $ruta = $portada->storeAs('portadas', $name, 'public');

        return $ruta;
    }


    
    function show(Pelicula $pelicula): View {

        return view('pelicula.show', ['pelicula' => $pelicula]);

    }

    function edit(Pelicula $pelicula): View {

        return view('pelicula.edit', ['pelicula' => $pelicula]);

    }

    function update(Request $request, Pelicula $pelicula, TmdbService $tmdbService): RedirectResponse {

        $bestMatch = null; 

        if (!$request->hasFile('portada')) {
            $searchResults = $tmdbService->searchMovie($request->titulo);

            if (!empty($searchResults['results'])) {
                $bestMatch = $searchResults['results'][0];
            }
        }

        if($request->deleteImage == 'true' && $pelicula->portada) {
            Storage::delete($pelicula->portada);
            
            $pelicula->portada = null;
        }

        $result = false;
        $pelicula->fill($request->all());
        $txtmessage = "";

        try {

            if($request->hasFile('portada')) {
 
                $ruta = $this->uploadPortada($request, $pelicula);
                $pelicula->portada = $ruta;
                $pelicula->save();
            } 

            else if ($bestMatch && $bestMatch['poster_path']) {
                

                $imageUrl = $tmdbService->getImageUrl($bestMatch['poster_path']);
                

                $imageContents = \Illuminate\Support\Facades\Http::get($imageUrl)->body();
                

                $filename = 'portadas/' . $pelicula->id . '.jpg';
                

                \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageContents);

                $pelicula->portada = $filename;
                $pelicula->save(); 
                
                $txtmessage .= " (Portada de TMDb descargada y aplicada)";
            }

        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe una película con esa información.";

        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        }catch (\Exception $e) {

            $txtmessage = "Error fatal al actualizar la película.";
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if ($result) {

            return redirect()->route('main')->with($message);
        } else {

            return back()->withInput()->withErrors($message);
        }
    }

    function destroy(Pelicula $pelicula): RedirectResponse {
        try {
            if ($pelicula->portada) {
                Storage::delete($pelicula->portada);
            }

            $result = $pelicula->delete();
            $textmessage = 'La película se ha eliminado.';

        } catch (\Illuminate\Database\QueryException $e) {

            $result = false;
            $textmessage = 'Error: Esta película no puede eliminarse porque tiene copias asociadas.';

        } catch (\Exception $e) {

            $result = false;
            $textmessage = 'Error fatal al eliminar la película.';
        }

        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if ($result){

                return redirect()->route('main')->with($message);

            } else {

                return back()->withInput()->withErrors($message);

            }
    }
}