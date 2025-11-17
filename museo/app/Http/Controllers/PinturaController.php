<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pintor;
use App\Models\Pintura;

class PinturaController extends Controller {
    
    public function create() {
        $pintor = Pintor::find(2);

        $pintura = new Pintura;

        $pintura->titulo = 'Las meninas';
        $pintura->descripcion = 'Muy popular y de grandes dimensiones.';
        $pintura->pintor_id = $pintor->id;

        $pintura->save();

        $pintura = new Pintura;

        $pintura->titulo = 'Vieja friendo huevos';
        $pintura->descripcion = 'Pintado en Sevilla en 1618';
        $pintura->pintor_id = $pintor->id;

        $pintura->save();
    }

    public function index() {
        $pinturas = Pintura::all();

        return $pinturas;
    }
}
