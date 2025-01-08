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
        Schema::table('contratoautretiros', function (Blueprint $table) {
            $table->string('rut',15)->nullable()->after('nombre'); //->unique(); //RUT
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratoautretiros', function (Blueprint $table) {
            $table->dropColumn('rut');
        });
    }
};
