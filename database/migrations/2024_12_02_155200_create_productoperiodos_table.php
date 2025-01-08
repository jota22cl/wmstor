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
        Schema::create('productoperiodos', function (Blueprint $table) {
            $table->id();
            // relacion llave tabla Productos
            $table->unsignedBigInteger('producto_id'); //Campo de llave foranea
            $table->foreign('producto_id')->references('id')->on('productos'); //Definicion campo llave foranea
            // ---- Periodo del producto AAAAMM ----
            $table->string('periodo',6);
            // datos
            $table->decimal('saldo_ini',10,2)->default(0);
            $table->decimal('entradas',10,2)->default(0);
            $table->decimal('salidas',10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productoperiodos');
    }
};
