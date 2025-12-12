<?php

namespace App\Http\Controllers;


// Importamos el modelo y clases necesarias
use App\Models\Alquiler; 
use App\Models\Cliente; 
use App\Models\Copia; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AlquilerCreateRequest; 
use App\Http\Requests\AlquilerEditRequest; 


class AlquilerController extends Controller {
    

    function index(): View {

        $alquileres = Alquiler::with(['copia.pelicula', 'cliente'])->get();
        return view('alquiler.index', ['alquileres' => $alquileres]);
    }

    function create(): View {

        $clientes = Cliente::pluck('nombre', 'id');
        $copias = Copia::with('pelicula')->where('estado', 'Disponible')->get();
        return view('alquiler.create', ['clientes' => $clientes, 'copias' => $copias]);

    }

    function store(AlquilerCreateRequest $request): RedirectResponse {
        
        $alquiler = new Alquiler($request->all());
        $result = false;
        $txtmessage = "";

        try {
            $result = $alquiler->save(); 
            $txtmessage = "El registro de alquiler se ha creado correctamente.";
            
            $copia = Copia::find($request->idcopia);

            if($alquiler->fecha_dev == null) {
                $copia->estado = 'Alquilado';
                $copia->save();
            }

        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = "Clave duplicada: Ya existe un registro de alquiler.";
        } 

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if($result){

            return redirect()->route('main')->with($message);

        } else {

            return back()->withInput()->withErrors($message);

        }
    }

    function edit(Alquiler $alquiler): View {

        $copias = Copia::with('pelicula')->where('estado', 'Alquilado')->get();
        $clientes = Cliente::pluck('nombre', 'id');
        return view('alquiler.edit', ['alquiler' => $alquiler, 'copias' => $copias, 'clientes' => $clientes]);

    }


    function update(Request $request, Alquiler $alquiler): RedirectResponse {

        $fechaDevAnterior = $alquiler->fecha_dev;

        $result = false;
        $alquiler->fill($request->all());
        $txtmessage = "";

        $devolucionCambiada = ($fechaDevAnterior === null  && $alquiler->fecha_dev !== null);

        try {

            $result = $alquiler->save();
            $txtmessage = "El registro de alquiler se ha actualizado correctamente.";

            $copia = \App\Models\Copia::find($alquiler->idcopia); 

            if($devolucionCambiada) {
                $copia->estado = 'Disponible';
                $copia->save();
            }

        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe un registro idéntico de alquiler.";

        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        } catch (\Exception $e) {

            $txtmessage = "Error fatal al actualizar el alquiler.";
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if($result) {

            return redirect()->route('main')->with($message);

        } else {

            return back()->withInput()->withErrors($message);
        }
    }

    function destroy(Alquiler $alquiler): RedirectResponse {

        try{

            $result = $alquiler->delete();
            $textmessage='El registro de alquiler se ha eliminado.';

        } catch(\Exception $e) {

            $result = false;
            $textmessage='Error al eliminar el registro de alquiler.';
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