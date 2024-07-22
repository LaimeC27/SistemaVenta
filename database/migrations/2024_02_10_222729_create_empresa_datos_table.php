<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresa_datos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('rup');
            $table->string('correo_empresa');
            $table->timestamps();
        });

        \App\Models\empresaDatos::create([
            'nombre_empresa' => 'Empresa de Prueba',
            'direccion' => 'Calle 123',
            'telefono' => '123456789',
            'rup' => '123456789',
            'correo_empresa' => 'Prueba@gmail.com' 
        ]);

    }


   


    public function down(): void
    {
        Schema::dropIfExists('empresa_datos');
    }
};
// 