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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            // relacion llave empresa
            $table->unsignedBigInteger('empresa_id'); //Campo de llave foranea
            $table->foreign('empresa_id')->references('id')->on('empresas'); //Definicion campo llave foranea
            // relacion llave contrato (identfica CCosto/Cliente/Bodega)
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            // ---- datos ----
            $table->enum('guia', ['i', 's']);   //'i' = Guia de Ingreso,  's' = Guia de Salida
            $table->enum('tipoGuia', ['n', 'ab', 'ac']);   //'n' = Guia NORMAL,  'ab' = Ajuste Bodega,  'ac' = Ajuste Cliente
            $table->bigInteger('numeroGuia');
            $table->date('fechaGuia');
            $table->dateTime('fechaDigitacion');
            $table->string('periodo',6);
            // Autorizados para mover mercaderia
            $table->unsignedBigInteger('contratoautretiro_id'); //Campo de llave foranea
            $table->foreign('contratoautretiro_id')->references('id')->on('contratoautretiros'); //Definicion campo llave foranea
            $table->string('empresatransporte',30)->nullable();
            $table->string('patente',10)->nullable();
            $table->string('choferRut',15)->nullable();
            $table->string('choferNombre',50)->nullable();
            $table->boolean('correoCliente');
            $table->bigInteger('guiaCliente')->nullable();
            $table->bigInteger('factCliente')->nullable();
            // bodeguero, quien recibe o entrega la mercaderia
            $table->unsignedBigInteger('user_id'); //Campo de llave foranea
            $table->foreign('user_id')->references('id')->on('users'); //Definicion campo llave foranea
            // bodeguero, quien recibe o entrega la mercaderia
            $table->unsignedBigInteger('operario_id'); //Campo de llave foranea
            $table->foreign('operario_id')->references('id')->on('operarios'); //Definicion campo llave foranea
            $table->string('observacion',1000)->nullable();
            $table->enum('estado', ['d', 'e']);   // 'd' = Digitado,   'e' = Emitido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
