<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('IdenficacionCliente');
            $table->string('nombreCliente');
            $table->string('emailCliente');
            $table->string('telefonoCliente');
            $table->string('direccionCliente');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
