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
        Schema::create('valorservicios', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // relacion llave C.Costo
            $table->unsignedBigInteger('ccosto_id'); //Campo de llave foranea
            $table->foreign('ccosto_id')->references('id')->on('ccostos'); //Definicion campo llave foranea
            //fecha de vigencia de los montos
            $table->date('fecha');
            // relacion llave servicio
            $table->unsignedBigInteger('servicio_id'); //Campo de llave foranea
            $table->foreign('servicio_id')->references('id')->on('servicios'); //Definicion campo llave foranea
            // ---- datos ----
            $table->decimal('valor',6,4)->default(0)->nullable(); // valor del servicio en U.F.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valorservicios');
    }
};
