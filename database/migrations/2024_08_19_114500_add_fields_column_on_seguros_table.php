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
        Schema::table('pseguros', function (Blueprint $table) {
            $table->date('periodoInicial')->nullable()->after('valor');
            $table->date('periodoFinal')->nullable()->after('periodoInicial');
            $table->string('polizaSeguro',20)->nullable()->after('periodoFinal');
            $table->string('ciaSeguro',200)->nullable()->after('polizaSeguro');
            // deducible por Robo e Incendio
            $table->bigInteger('montoDeducibleRoboIncendio')->default(0)->nullable()->after('ciaSeguro'); //Valor del deducible
            $table->unsignedBigInteger('monedaDeducibleRoboIncendio_id')->nullable()->after('montoDeducibleRoboIncendio'); //Campo de llave foranea
            $table->foreign('monedaDeducibleRoboIncendio_id')->references('id')->on('monedas'); //Definicion campo llave foranea
            // gastos comunes
            $table->bigInteger('montoDeducibleTerremoto')->default(0)->nullable()->after('monedaDeducibleRoboIncendio_id'); //Valor del deducible
            $table->unsignedBigInteger('monedaDeducibleTerremoto_id')->nullable()->after('montoDeducibleTerremoto'); //Campo de llave foranea
            $table->foreign('monedaDeducibleTerremoto_id')->references('id')->on('monedas'); //Definicion campo llave foranea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pseguros', function (Blueprint $table) {
            $table->dropColumn('periodoInicial');
            $table->dropColumn('periodoFinal');
            $table->dropColumn('polizaSeguro');
            $table->dropColumn('ciaSeguro');
            $table->dropColumn('montoDeducibleRoboIncendio');
            $table->dropForeign(['monedaDeducibleRoboIncendio_id']);
            $table->dropColumn('monedaDeducibleRoboIncendio_id');
            $table->dropColumn('montoDeducibleTerremoto');
            $table->dropForeign(['monedaDeducibleTerremoto_id']);
            $table->dropColumn('monedaDeducibleTerremoto_id');
        });
    }
};
