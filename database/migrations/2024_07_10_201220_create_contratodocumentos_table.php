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
        Schema::create('contratodocumentos', function (Blueprint $table) {
            $table->id();
            // relacion llave contrato
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            //datos
            $table->enum('tipo', ['escritura','actadirectorio','constitucion','certvigencia','rutreplegal','rutsii','contrato','otro']);
            $table->string('observacion',50)->nullable();
            $table->string('documento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratodocumentos');
    }
};
