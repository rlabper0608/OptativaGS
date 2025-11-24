<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PintorSeeder extends Seeder
{
    public function run(): void {
        
        DB::table('pintors')->insert([
            [
                'nombre' => 'Leonardo Da Vinci',
                'bio'   => 'Pintor renacentista, ingeniero, inventor, etc.',
                'pintor_foto' => 'img/pintores/da_vinci.jpg'
            ],
            [
                'nombre' => 'Diego Velazquez',
                'bio'   => 'Pintor barroco español y maestro universal.',
                'pintor_foto' => 'img/pintores/Velázquez.jpg'
            ],
            [
                'nombre' => 'Rembrandt',
                'bio'   => 'Pintor muy admirado por su vívido realismo.',
                'pintor_foto' => 'img/pintores/Rembrandt.jpg'
            ],
            [
                'nombre' => 'Franscisco de Goya',
                'bio'   => 'Pintor español precursor del expresionismo.',
                'pintor_foto' => 'img/pintores/goya.jpg'
            ],
        ]);

    }
}
