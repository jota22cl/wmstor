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
        Schema::create('ciudads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',80)->unique();
            // -------------- manera de mostrar un campo de llave foranea ------------------
            //          Nopmbre del campo          Nombre tabla
            //$table->foreignId('region_id')->constrained('regions')->cascadeOnDelete(); //llave foranea
            $table->unsignedBigInteger('region_id'); //Campo de llave foranea
            $table->foreign('region_id')->references('id')->on('regions'); //Definicion campo llave foranea
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciudads');
    }
};
