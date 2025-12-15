<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Copia;

class CopiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Copia::create([
            'idpelicula' => 1,
            'codigo_barras' => '1111111111',
            'estado' => 'Disponible',
            'formato' => 'Blu-ray',
        ]);
        Copia::create([
            'idpelicula' => 1,
            'codigo_barras' => '1111111112',
            'estado' => 'Alquilado', 
            'formato' => 'DVD',
        ]);
        
        Copia::create([
            'idpelicula' => 2,
            'codigo_barras' => '1111111113',
            'estado' => 'Disponible',
            'formato' => 'DVD',
        ]);

        Copia::create([
            'idpelicula' => 3,
            'codigo_barras' => '1111111114',
            'estado' => 'Disponible',
            'formato' => 'Blu-ray',
        ]);
        
        Copia::create([
            'idpelicula' => 4,
            'codigo_barras' => '1111111115',
            'estado' => 'Estropeado', 
            'formato' => 'CD',
        ]);
    }
}