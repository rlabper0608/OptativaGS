<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ValoracionController extends Controller {
    
   function store(Request $request) {

        $result = false;
        $txtMessage = 'No se ha podido agregar el comentario.';
        $valoracion = new Valoracion($request->all());

        try {

            $result = $valoracion->save();
            // guardo en la sesión que ha creado ese mensaje
            $valoraciones = $request->session()->get('valoraciones');

            if($valoraciones == null || !is_array($valoraciones)) {

                $valoraciones = [];

            }
            $valoraciones[] = $valoracion->id;

            $request->session()->put('valoraciones', $valoraciones);
            // session();
            $txtMessage = "Comentario agregadado correctamente";

        } catch (\Exception $e) {

            $txtMessage = "El comentario no se ha agregado debido a un error";

        }

        $message = [
                "mensajeTexto" => $txtMessage,
            ];

        if($result) {
            return back()->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function edit(Request $request, Valoracion $valoracion): View {

        if($request->session()->get('valoraciones') != null &&
             in_array($valoracion->id, $request->session()->get('valoraciones'))) {

                return view('valoracion.edit',  ['valoracion' => $valoracion]);

        } else {
            return redirect()->route('main');
        }
    }

    function update(Request $request, Valoracion $valoracion): RedirectResponse {

        if($request->session()->get('valoraciones') != null &&
            in_array($valoracion->id, $request->session()->get('valoraciones'))) {
                $result = false;

                $valoracion->fill($request->all());

                try {

                    $result = $valoracion->save(); 

                    $txtmessage = "Comentario actualizado con exito";

                } catch (\Exception $e) {

                    $txtmessage = "No se ha podido modificar el comentario por un error";
                }

                $message = [
                        "mensajeTexto" => $txtmessage,
                    ];

                if($result){

                    return redirect() -> route('pelicula.show', $valoracion->idpelicula)->with($message);

                } else {
                    return back()->withInput()->withErrors($message);
                }

            } else {
                abort(404);
            }
        
    }
}
