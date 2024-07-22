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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codigoProducto')->unique();
            $table->String('imagenProducto')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->String('descripcion')->nullable();
            $table->float('precio_compra');
            $table->float('precio_venta');
            $table->integer('stock_producto')->nullable();
            $table->integer('stockMinimo_producto')->nullable();
            $table->integer('ventas_producto')->nullable();
          
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
