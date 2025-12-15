<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'DNI' => '12345678A',
            'nombre' => 'Ana',
            'apellidos' => 'Martínez López',
            'telefono' => '600111222',
            'email' => 'ana.martinez@mail.com',
            'foto' => null, 
        ]);

        Cliente::create([
            'DNI' => '87654321B',
            'nombre' => 'Carlos',
            'apellidos' => 'Ruiz García',
            'telefono' => '600333444',
            'email' => 'carlos.ruiz@mail.com',
            'foto' => null, 
        ]);
        
        Cliente::create([
            'DNI' => '45678901C',
            'nombre' => 'Elena',
            'apellidos' => 'Sánchez Torres',
            'telefono' => '600555666',
            'email' => 'elena.sanchez@mail.com',
            'foto' => null, 
        ]);
    }
}