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
            $table->enum('tipoArriendo', ['Mensual','por Mt2', 'por Pallet',])->nullable()->after('observacion');
            $table->decimal('valorArriendo',6,4)->default(0)->nullable()->after('tipoArriendo');
            $table->decimal('montoMinimo',6,4)->default(0)->nullable()->after('valorArriendo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('tipoArriendo');
            $table->dropColumn('valorArriendo');
            $table->dropColumn('montoMinimo');
        });
    }
};
