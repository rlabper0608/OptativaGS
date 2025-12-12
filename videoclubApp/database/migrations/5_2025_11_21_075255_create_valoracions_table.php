<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('valoracion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idpelicula');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->foreign('idpelicula')->references('id')->on('pelicula')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('valoracion');
    }
};
