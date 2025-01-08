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
        Schema::create('contratoreplegals', function (Blueprint $table) {
            $table->id();
            // relacion llave contrato
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            //datos
            $table->string('rut',15)->nullable(); //->unique(); //RUT
            $table->string('nombre',150)->nullable(); //->unique();
            $table->string('telefono',30)->nullable();
            $table->string('celular',30)->nullable();
            $table->string('email',150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratoreplegals');
    }
};
