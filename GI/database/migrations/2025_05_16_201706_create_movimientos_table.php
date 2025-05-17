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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id(); // ID único del movimiento

            // Relación con productos
            $table->foreignId('producto_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Tipo: venta o reposición
            $table->enum('tipo', [
                'venta', 
                'reponer'
            ])->default('venta');

            // Unidad en la que se vendió o reponía
            $table->enum('unidad_venta', [
                'kilogramos', 
                'gramos', 
                'litros', 
                'mililitros', 
                'centimetro', 
                'metro', 
                'unidad'
            ])->default('kilogramos');

            // Cantidad movida
            $table->decimal('cantidad', 8, 2);

            // Fecha del movimiento
            $table->date('fecha')->default(now());

            $table->text('descripcion')->nullable(); // Campo opcional


            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
      * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};