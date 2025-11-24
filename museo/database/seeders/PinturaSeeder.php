<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinturaSeeder extends Seeder
{
    public function run(): void {
        
        DB::table('pinturas')->insert([
            [
                'titulo' => 'Las meninas',
                'description' => 'Muy popular y de grandes dimensiones.',
                'cuadro' => 'img/pinturas/Las_Meninas_01.jpg',
                'pintor_id' => 1
            ],
            [
                'titulo' => 'Vieja friendo huevos',
                'description' => 'Pintado en Sevilla en 1618',
                'cuadro' => 'img/pinturas/vieja_friendo_huevos.jpg',
                'pintor_id' => 2
            ]
        ]);
    }
}
