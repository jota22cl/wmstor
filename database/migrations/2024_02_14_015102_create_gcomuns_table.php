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
        Schema::create('gcomuns', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // ---- datos ----
            $table->string('codigo',10); //->unique();
            $table->string('descripcion',40); //->unique();
            $table->decimal('valor',4,2);
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gcomuns');
    }
};
