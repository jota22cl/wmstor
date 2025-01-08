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
        Schema::table('contratos', function (Blueprint $table) {
            // gastos comunes
            $table->unsignedBigInteger('gastosComunes_id')->nullable()->after('observacion'); //Campo de llave foranea
            $table->foreign('gastosComunes_id')->references('id')->on('gcomuns'); //Definicion campo llave foranea
            // gastos de administracion
            $table->unsignedBigInteger('gastosAdministracion_id')->nullable()->after('gastosComunes_id'); //Campo de llave foranea
            $table->foreign('gastosAdministracion_id')->references('id')->on('gadmins'); //Definicion campo llave foranea
            // seguros
            $table->unsignedBigInteger('primaSeguro_id')->nullable()->after('gastosAdministracion_id'); //Campo de llave foranea
            $table->foreign('primaSeguro_id')->references('id')->on('contratos'); //Definicion campo llave foranea
            // moneda del monto asegurado
            $table->unsignedBigInteger('monedaMontoAsegurado_id')->nullable()->after('primaSeguro_id'); //Campo de llave foranea
            $table->foreign('monedaMontoAsegurado_id')->references('id')->on('monedas'); //Definicion campo llave foranea
            // campo normal
            $table->bigInteger('montoAsegurado')->nullable()->after('monedaMontoAsegurado_id');
            $table->boolean('garantiaReciboGenerado')->nullable()->after('garantiaPago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['gastosComunes_id']);
            $table->dropColumn('gastosComunes_id');
            $table->dropForeign(['gastosAdministracion_id']);
            $table->dropColumn('gastosAdministracion_id');
            $table->dropForeign(['primaSeguro_id']);
            $table->dropColumn('primaSeguro_id');
            $table->dropForeign(['monedaMontoAsegurado_id']);
            $table->dropColumn('monedaMontoAsegurado_id');
            $table->dropColumn('montoAsegurado');
            $table->dropColumn('garantiaReciboGenerado');
        });
    }
};
