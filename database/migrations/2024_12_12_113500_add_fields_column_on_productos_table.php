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
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('reservado',12,2)->default(0)->after('inventariable');
            $table->decimal('totalSalidas',12,2)->default(0)->after('inventariable');
            $table->decimal('totalEntradas',12,2)->default(0)->after('inventariable');
            $table->decimal('saldoInicial',12,2)->default(0)->after('inventariable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('reservado');
            $table->dropColumn('totalSalidas');
            $table->dropColumn('totalEntradas');
            $table->dropColumn('saldoInicial');
        });
    }
};
