<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('DNI', 9)->unique();
            $table->string('nombre', 60);
            $table->string('apellidos', 60);
            $table->string('telefono', 9);
            $table->string('email', 70)->unique();
            $table->string('foto',100)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cliente');
    }
};
