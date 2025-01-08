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
            $table->bigInteger('montoGarantia')->nullable()->after('observacion');
            $table->boolean('garantiaPago')->nullable()->after('montoGarantia');
            $table->bigInteger('garantiaMontoPago')->nullable()->after('garantiaPago');
            $table->date('garantiaFechaPago')->nullable()->after('garantiaMontoPago');
            $table->string('garantiaObservacionPago',1000)->nullable()->after('garantiaFechaPago');
            $table->boolean('garantiaDevolucion')->nullable()->after('garantiaObservacionPago');
            $table->bigInteger('garantiaMontoDevolucion')->nullable()->after('garantiaDevolucion');
            $table->date('garantiaFechaDevolucion')->nullable()->after('garantiaMontoDevolucion');
            $table->string('garantiaObservacionDevolucion',1000)->nullable()->after('garantiaFechaDevolucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('montoGarantia');
            $table->dropColumn('garantiaPago');
            $table->dropColumn('garantiaMontoPago');
            $table->dropColumn('garantiaFechaPago');
            $table->dropColumn('garantiaObservacionPago');
            $table->dropColumn('garantiaDevolucion');
            $table->dropColumn('garantiaMontoDevolucion');
            $table->dropColumn('garantiaFechaDevolucion');
            $table->dropColumn('garantiaObservacionDevolucion');
        });
    }
};
