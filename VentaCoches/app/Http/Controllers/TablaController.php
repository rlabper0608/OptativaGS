<?php

namespace App\Http\Controllers;

use App\Models\venta_coches;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TablaController extends Controller {
    
    function tabla(): View {
        $coches = venta_coches::all();
        return view('tabla.template', ['coches'=>$coches]);
    }
}
