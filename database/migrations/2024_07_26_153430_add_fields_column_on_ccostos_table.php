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
        Schema::table('ccostos', function (Blueprint $table) {
            $table->boolean('inventario')->default(false)->after('descripcion');
            $table->boolean('garantia')->default(false)->after('inventario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ccostos', function (Blueprint $table) {
            $table->dropColumn('garantia');
            $table->dropColumn('inventario');
        });
    }
};
