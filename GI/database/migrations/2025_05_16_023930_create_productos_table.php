<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->enum('origen', ['Fabricado', 'Adquirido'])->default('Fabricado');
            $table->enum('unidad', ['kilogramos', 'gramos','litros','mililitros', 'centimetro', 'metro','unidad'])->default('kilogramos');       
            $table->decimal('stock', 25, 2)->default(5);
            $table->decimal('compra', 25, 2)->nullable(0);
            $table->decimal('venta', 25, 2)->nullable(0);
            
            $table->boolean('es_perecedero')->default(false);
            $table->date('fecha_caducidad')->nullable();
            $table->index(['es_perecedero', 'fecha_caducidad']);
        
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};