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
        Schema::create('lasmonedas', function (Blueprint $table) {
            //
            $table->id();

            $table->unsignedBigInteger('empresa_id')->index(); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea

            $table->string('codigo',30)->index();
            $table->string('simbolo',10);
            $table->boolean('vigente')->default(true);

            //$table->primary(['id','empresa_id','codigo']); // Ambos campos hacen una Key compuesta
            //$table->primary('id'); // Ambos campos hacen una Key compuesta

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lasmonedas');
    }
};
