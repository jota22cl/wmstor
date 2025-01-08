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
        Schema::table('contratoreplegals', function (Blueprint $table) {
            $table->enum('titulo', ['don', 'doña',])->nullable()->after('rut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratoreplegals', function (Blueprint $table) {
            $table->dropColumn('titulo');
        });
    }
};
