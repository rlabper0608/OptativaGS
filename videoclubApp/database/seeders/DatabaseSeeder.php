<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asumimos que quieres un usuario admin

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin VideoClub',
            'email' => 'admin@videoclub.com',
            'email_verified_at' => now(),
            'password' => 12345678, // Contraseña: 
        ]);

        $this->call([
            PeliculaSeeder::class,
            ClienteSeeder::class,
            CopiaSeeder::class,
        ]);
    }
}