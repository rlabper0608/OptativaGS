<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alquiler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idcopia');
            $table->foreignId('idcliente');
            $table->date('fecha_dev')->nullable();
            $table->date('fecha_sal')->nullable();
            $table->decimal('precio', 6,2);
            $table->foreign('idcopia')->references('id')->on('copia');
            $table->foreign('idcliente')->references('id')->on('cliente');
            $table->timestamps();

        });
    }

    public function down(): void {
        Schema::dropIfExists('alquiler');
    }
};
