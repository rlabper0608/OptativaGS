<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        
        Schema::create('copia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idpelicula');
            $table->integer('codigo_barras')->unique();
            $table->enum('estado', ['Disponible', 'Alquilado', 'Estropeado'])->default('Disponible');
            $table->enum('formato',['DVD', 'Blu-Ray', 'CD'])->default('DVD');
            $table->timestamps();
            $table->foreign('idpelicula')->references('id')->on('pelicula')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
         Schema::dropIfExists('copia');
    }
};
