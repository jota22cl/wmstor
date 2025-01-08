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
        Schema::create('contratovalors', function (Blueprint $table) {
            $table->id();
            // relacion llave contrato
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            // relacion llave servicio
            $table->unsignedBigInteger('servicio_id'); //Campo de llave foranea
            $table->foreign('servicio_id')->references('id')->on('servicios'); //Definicion campo llave foranea
            // ---- datos ----
            $table->date('fecha')->nullable();
            $table->decimal('valor',8,4)->default(0)->nullable(); // valor del servicio en U.F.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratovalors');
    }
};
