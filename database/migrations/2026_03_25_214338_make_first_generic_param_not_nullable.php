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
        Schema::table('exm_generica_plantillas', function (Blueprint $table) {
            $table->string('param_1', 100)->nullable(false)->change();
            $table->string('resultado_1', 100)->nullable(false)->change();
            $table->string('unidad_med_1', 50)->nullable(false)->change();
            $table->string('rango_ref_1', 100)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exm_generica_plantillas', function (Blueprint $table) {
            $table->string('param_1', 100)->nullable()->change();
            $table->string('resultado_1', 100)->nullable()->change();
            $table->string('unidad_med_1', 50)->nullable()->change();
            $table->string('rango_ref_1', 100)->nullable()->change();
        });
    }
};
