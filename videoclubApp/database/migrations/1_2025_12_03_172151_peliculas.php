<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pelicula', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 60);
            $table->string('director', 60);
            $table->string('genero', 60);
            $table->text('actores');
            $table->date('fecha_estreno');
            $table->integer('duracion');
            $table->enum('clasificacion', ['Apta para todos los publicos', '+7', '+12', '+16', '+18'])->default('Apta para todos los publicos');
            $table->string('portada',100)->unique()->nullable();
            $table->timestamps();
            $table->unique(['titulo','director']);

        });
    }

    public function down(): void {
        Schema::dropIfExists('pelicula');
    }
};
