<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       DB::table('venta_coches')->insert([
            ['marca' => 'Toyota', 'modelo' => 'Airguay', 'precio' => 9000, 'year' => 2010],
            ['marca' => 'Honda', 'modelo' => 'Civic', 'precio' => 8500, 'year' => 2011],
            ['marca' => 'Ford', 'modelo' => 'Focus', 'precio' => 7800, 'year' => 2012],
            ['marca' => 'Chevrolet', 'modelo' => 'Cruze', 'precio' => 8200, 'year' => 2013],
            ['marca' => 'Nissan', 'modelo' => 'Altima', 'precio' => 9500, 'year' => 2014],
            ['marca' => 'Kia', 'modelo' => 'Rio', 'precio' => 7000, 'year' => 2015],
            ['marca' => 'Hyundai', 'modelo' => 'Elantra', 'precio' => 8800, 'year' => 2016],
            ['marca' => 'Mazda', 'modelo' => '3', 'precio' => 9100, 'year' => 2017],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'precio' => 10000, 'year' => 2018],
            ['marca' => 'Peugeot', 'modelo' => '208', 'precio' => 8900, 'year' => 2019],
            ['marca' => 'Renault', 'modelo' => 'Clio', 'precio' => 8600, 'year' => 2020],
            ['marca' => 'Seat', 'modelo' => 'Ibiza', 'precio' => 8700, 'year' => 2021],
            ['marca' => 'Skoda', 'modelo' => 'Fabia', 'precio' => 8800, 'year' => 2022],
            ['marca' => 'Fiat', 'modelo' => 'Punto', 'precio' => 7600, 'year' => 2013],
            ['marca' => 'Suzuki', 'modelo' => 'Swift', 'precio' => 8300, 'year' => 2015],
            ['marca' => 'Citroen', 'modelo' => 'C3', 'precio' => 8400, 'year' => 2016],
            ['marca' => 'Opel', 'modelo' => 'Corsa', 'precio' => 8500, 'year' => 2017],
            ['marca' => 'Mitsubishi', 'modelo' => 'Lancer', 'precio' => 9200, 'year' => 2018],
            ['marca' => 'Subaru', 'modelo' => 'Impreza', 'precio' => 9700, 'year' => 2019],
            ['marca' => 'BMW', 'modelo' => '320i', 'precio' => 15000, 'year' => 2020],
        ]);
    }
}
