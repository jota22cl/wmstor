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
        Schema::create('bodegas', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // ---- datos ----
            $table->string('codigo',10);   //este debiera de ser unico.... para Empresa/Ccosto/codigo
            $table->string('ubicacion')->nullable();

            $table->decimal('ancho',6,2)->default(0)->nullable();
            $table->decimal('largo',6,2)->default(0)->nullable();
            $table->decimal('alto',6,2)->default(0)->nullable();
            $table->decimal('mt2',8,2)->default(0);    // no es calculado, es para facturar
            $table->decimal('mt2calc',8,2)->default(0)->nullable();    // calculado, no es para facturar, solo referencial
            $table->decimal('mt3calc',8,2)->default(0)->nullable();    // calculado, no es para facturar, solo referencial

            $table->decimal('ancho_porton',4,2)->default(0)->nullable();
            $table->decimal('alto_porton',4,2)->default(0)->nullable();
            $table->decimal('lateral_izq_porton',4,2)->default(0)->nullable();
            $table->decimal('lateral_der_porton',4,2)->default(0)->nullable();

            $table->unsignedBigInteger('tipoporton_id')->nullable(); //Campo de llave foranea
            $table->foreign('tipoporton_id')->references('id')->on('tipoportons'); //Definicion campo llave foranea

            $table->unsignedBigInteger('tipoconstruccion_id')->nullable(); //Campo de llave foranea
            $table->foreign('tipoconstruccion_id')->references('id')->on('tipoconstruccions'); //Definicion campo llave foranea

            $table->string('observacion',1000)->nullable();
            $table->string('equipamiento',1000)->nullable();

            $table->boolean('medidasok')->default(false);  //indica si los Mts estan comprobados
            $table->boolean('compartida')->default(false);  //son las ADM como Seco, Frio, Congelado, ISP. LLM no es compartida
            $table->boolean('ocupada')->default(false);   //esta tendra valor siempre y cuando no sea compartida
            $table->boolean('vigente')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas');
    }
};
