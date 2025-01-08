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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // relacion llave contrato (del contrato se puede obtener el CCosto y el Cliente)
            $table->unsignedBigInteger('contrato_id'); //Campo de llave foranea
            $table->foreign('contrato_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            // ---- datos ----
            $table->string('codigo',15);
            $table->string('descripcion',60);
            // definicion unidad de medida de INGRESO
            $table->unsignedBigInteger('unimed_ingreso_id'); //Campo de llave foranea
            $table->foreign('unimed_ingreso_id')->references('id')->on('unimedidas'); //Definicion campo llave foranea
            // definicion unidad de medida de INGRESO
            $table->unsignedBigInteger('unimed_salida_id'); //Campo de llave foranea
            $table->foreign('unimed_salida_id')->references('id')->on('unimedidas'); //Definicion campo llave foranea
            $table->decimal('factor_conversion',6,2)->default(0)->nullable();
            $table->string('codbarra_cliente',30)->nullable();
            $table->string('codbarra_bodega',30)->nullable();
            $table->string('codbarra_ean13',30)->nullable();
            $table->string('codbarra_dun14',30)->nullable();
            $table->string('lote',30)->nullable();
            $table->date('fechacaducidad')->nullable();
            $table->boolean('inventariable')->default(true);
            $table->boolean('vigente')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
