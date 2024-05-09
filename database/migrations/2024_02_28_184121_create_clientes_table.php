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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('rut',15)->unique(); //RUT
            $table->string('nombre',150)->unique();
            $table->string('sigla',50);
            $table->string('giro',150);
            $table->string('direccion',150);
            $table->unsignedBigInteger('comuna_id'); //Campo llave foranea
            $table->foreign('comuna_id')->references('id')->on('comunas'); //Definicion campo llave foranea
            $table->string('telefono',30);
            $table->string('email',150);
            $table->string('observacion',1000);
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
