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
        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',80)->unique();
            // -------------- manera de mostrar un campo de llave foranea ------------------
            //          Nopmbre del campo          Nombre tabla
            //$table->foreignId('ciudad_id')->constrained('ciudads')->cascadeOnDelete(); //llave foranea
            $table->unsignedBigInteger('ciudad_id'); //Campo llave foranea
            $table->foreign('ciudad_id')->references('id')->on('ciudads'); //Definicion campo llave foranea
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunas');
    }
};
