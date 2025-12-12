<?php

namespace App\Http\Controllers;

// Importamos el modelo y clases necesarias
use App\Models\Cliente; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClienteCreateRequest; 
use App\Http\Requests\ClienteEditRequest; 



class ClienteController extends Controller {
    
    function index(): View {
        $clientes = Cliente::all(); 
        return view('cliente.index', ['clientes' => $clientes]);
    }


    function create(): View {
        return view('cliente.create');
    }

    function store(ClienteCreateRequest $request): RedirectResponse {
        
        $cliente = new Cliente($request->all());
        $result = false;
        $txtmessage = "";

        try {

            $result = $cliente->save(); 
            $txtmessage = "El cliente se ha añadido correctamente.";

            if($request->hasFile('foto')) {
                $ruta = $this->uploadFotografia($request, $cliente);
                $cliente->foto = $ruta;
                $cliente->save();
            }
            
        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe un cliente con esa información.";

        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        } catch (\Exception $e) {

            $txtmessage = "Error Fatal al guardar el cliente.";
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

    private function uploadFotografia(Request $request, Cliente $cliente): string {

        $foto = $request->file('foto'); 

        $name = $cliente->id . "." . $foto->getClientOriginalExtension();

        $ruta = $foto->storeAs('clientes', $name, 'public');

        return $ruta;
    }

    function show(Cliente $cliente): View {

        return view('cliente.show', ['cliente' => $cliente]); 
    }


    function edit(Cliente $cliente): View {

        return view('cliente.edit', ['cliente' => $cliente]); 
    }

    function update(ClienteEditRequest $request, Cliente $cliente): RedirectResponse { 

        if($request->deleteImage == 'true' && $cliente->foto) {
            Storage::delete($cliente->foto);
            
            $cliente->foto = null;
        }

        $result = false;
        $cliente->fill($request->all());
        $txtmessage = "";

        try {

            if($request->hasFile('foto')) {
                if ($cliente->foto) {
                    Storage::delete($cliente->foto); 
                }
                
                $ruta = $this->uploadFotografia($request, $cliente);
                $cliente->foto = $ruta;
            }

            $result = $cliente->save();
            $txtmessage = "El cliente se ha actualizado correctamente.";

        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = "Clave duplicada: Ya existe un cliente con esa información.";

        } catch(QueryException $e) {

            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";

        } catch (\Exception $e) {

            $txtmessage = "Error fatal al actualizar el cliente.";
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

    function destroy(Cliente $cliente): RedirectResponse {

        try{

            if ($cliente->foto) {
                 Storage::delete($cliente->foto);
            }

            $result = $cliente->delete();
            $textmessage='El cliente se ha eliminado.';

        } catch (\Illuminate\Database\QueryException $e) {

            $result = false;
            $textmessage = 'Error: Este cliente no puede eliminarse porque tiene alquileres vinculados.';

        } catch(\Exception $e) {

            $result = false;
            $textmessage='Error al eliminar el cliente.';
        }
        
        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if($result){

            return redirect()->route('main')->with($message);

        } else {
            
            return back()->withInput()->withErrors($message);
        }
    }
}