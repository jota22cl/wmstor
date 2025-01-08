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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // relacion llave cliente
            $table->unsignedBigInteger('cliente_id'); //Campo de llave foranea
            $table->foreign('cliente_id')->references('id')->on('clientes'); //Definicion campo llave foranea
            // relacion llave ccosto
            $table->unsignedBigInteger('ccosto_id'); //Campo de llave foranea
            $table->foreign('ccosto_id')->references('id')->on('ccostos'); //Definicion campo llave foranea
            // relacion llave bodega
            $table->unsignedBigInteger('bodega_id'); //Campo de llave foranea
            $table->foreign('bodega_id')->references('id')->on('bodegas'); //Definicion campo llave foranea
            // ---- datos ----
            $table->unsignedBigInteger('vendedor_id'); //Campo de llave foranea
            $table->foreign('vendedor_id')->references('id')->on('vendedors'); //Definicion campo llave foranea
            $table->integer('folioContrato');
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['elab', 'docum', 'firma','revision','completo', 'nulo']);
            $table->string('observacion',1000)->nullable();
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
