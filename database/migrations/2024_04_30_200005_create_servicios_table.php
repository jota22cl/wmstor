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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // campos
            $table->integer('prioridad');
            //$table->string('codigo',15);   //este debiera de ser unico.... para Empresa/codigo
            $table->string('descripcion',50);
            // definicion unidad de INGRESO
            $table->unsignedBigInteger('unimed_ingreso_id'); //Campo de llave foranea
            $table->foreign('unimed_ingreso_id')->references('id')->on('unimedidas'); //Definicion campo llave foranea
            // definicion unidad de COBRO
            $table->unsignedBigInteger('unimed_cobro_id'); //Campo de llave foranea
            $table->foreign('unimed_cobro_id')->references('id')->on('unimedidas'); //Definicion campo llave foranea
            // campos
            $table->decimal('factor_conversion',4,2)->default(0)->nullable();
            $table->string('codigo_flexline',4)->default("")->nullable();
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
