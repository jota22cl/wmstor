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
        Schema::table('servicios', function (Blueprint $table) {
            $table->boolean('imprimeEnContrato')->default(false)->after('codigo_flexline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn('imprimeEnContrato');
        });
    }
};
