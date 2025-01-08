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
        Schema::create('guiadetalles', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // relacion tabla Contratos
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            // relacion tabla Guias
            $table->unsignedBigInteger('guia_id'); //Campo de llave foranea
            $table->foreign('guia_id')->references('id')->on('guias'); //Definicion campo llave foranea
            $table->string('periodo',6);
            // relacion tabla Productos
            $table->unsignedBigInteger('producto_id'); //Campo de llave foranea
            $table->foreign('producto_id')->references('id')->on('productos'); //Definicion campo llave foranea
            $table->decimal('cantidad',8,2);
            $table->integer('factor'); // 1 / -1 (cantidad * factor) si factor = 1 suma (g.entrada) si -1 resta (g.salida)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guiadetalles');
    }
};
