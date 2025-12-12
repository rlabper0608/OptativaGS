<?php

namespace App\Http\Controllers;

use App\Models\Pelicula; 
use App\Models\Copia; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CopiaCreateRequest; 
use App\Http\Requests\CopiaEditRequest; 


class CopiaController extends Controller {
    
    function index(Request $request): View {
        $copias = Copia::all(); 
        $query = Copia::with('pelicula');

        $copias = $query->get();
        return view('copia.index', ['copias' => $copias]);
    }

    function create(): View {
        $peliculas = Pelicula::pluck('titulo', 'id');
        return view('copia.create', ['peliculas' => $peliculas]);
    }

    function store(CopiaCreateRequest $request): RedirectResponse {
        
        $copia = new Copia($request->all());
        $result = false;
        $txtmessage = "";

        try {

            $result = $copia->save(); 
            $txtmessage = "La copia ha sido registrada correctamente.";

            
        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe una copia con ese código de barras.";

        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        } catch (\Exception $e) {

            $txtmessage = "Error Fatal al guardar la copia: " . $e->getMessage();

        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if($result){
            return redirect()->route('main')->with($message);
        }else{
            return back()->withInput()->withErrors($message);
        }
    }

    function edit(Copia $copia): View {
        $peliculas = Pelicula::pluck('titulo', 'id');

        return view('copia.edit', ['copia' => $copia, 'peliculas' => $peliculas]);
    }

    function update(CopiaEditRequest $request, Copia $copia): RedirectResponse {

        $result = false;
        $copia->fill($request->all());
        $txtmessage = "";

        try {

            $result = $copia->save();
            $txtmessage = "La copia se ha actualizado correctamente.";

        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe otra copia con ese código de barras.";
            
        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        } catch (\Exception $e) {

            $txtmessage = "Error fatal al actualizar la copia.";
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if($result) {

            return redirect()->route('main')->with($message);

        } else{

            return back()->withInput()->withErrors($message);

        }
    }

    function destroy(Copia $copia): RedirectResponse {

        try{      

            $result = $copia->delete();
            $textmessage='La copia se ha eliminado.';

        } catch(\Exception $e) {

            $result = false;
            $textmessage='Error al eliminar la copia. Asegúrate de que no tenga registros de alquiler activos.';
        }
        
        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}