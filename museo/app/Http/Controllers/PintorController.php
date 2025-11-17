<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pintor;

class PintorController extends Controller {

    public function index() {
        $pintores = Pintor::all();
        return $pintores;
    }

    public function create() {
        $pintor = Pintor::find(2);

        $pintura = 
    }

    public function store(Request $request){
        $pintor = new Pintor;
        $pintor->nombre = 'Leonardo Da Vinci';
        $pintor->bio = 'Pintor renacentista, ingeniero, inventor, etc.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Diego Velazquez';
        $pintor->bio = 'Pintor barroco español y maestro universal.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Rembrandt';
        $pintor->bio = 'Pintor muy admirado por su vívido realismo.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Franscisco de Goya';
        $pintor->bio = 'Pintor español precursor del expresionismo.';
        $pintor->save();

        return 'Cuatro pintores insertados en la base de datos.';
    }

    public function show(string $id) {
        $pintor = Pintor::find($id);
        return $pintor;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $pintor = Pintor::where('nombre', 'Leonardo Da Vinci')->first();
        $pintor->nombre = 'Leonardo di ser Piero da Vinci';
        $pintor->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $pintor = Pintor::find(1);
        $pintor->delete();
    }
}
