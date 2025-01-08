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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razonsocial',200)->unique();
            $table->string('sigla',50)->unique();
            $table->string('rut',15)->unique();
            $table->string('giro',200);
            $table->string('direccion',200);
            $table->unsignedBigInteger('comuna_id'); //Campo llave foranea
            $table->foreign('comuna_id')->references('id')->on('comunas'); //Definicion campo llave foranea
            $table->string('telefono',30);
            $table->string('email',150);
            $table->string('repl_nombre',150);
            $table->string('repl_rut',15);
            $table->string('repl_telefono',30);
            $table->string('repl_email',150);
            $table->string('logo')->nullable();
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
