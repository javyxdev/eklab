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
        Schema::table('exm_hemograma_plantillas', function (Blueprint $table) {
            $table->string('globulos_rojos', 25)->nullable(false)->change();
            $table->string('hemoglobina', 25)->nullable(false)->change();
            $table->string('hematocrito', 25)->nullable(false)->change();
            $table->string('vcm', 25)->nullable(false)->change();
            $table->string('hcm', 25)->nullable(false)->change();
            $table->string('chcm', 25)->nullable(false)->change();
            $table->string('leucocitos', 25)->nullable(false)->change();
            $table->string('neutrofilos_segmentados', 25)->nullable(false)->change();
            $table->string('neutrofilos_en_banda', 25)->nullable(false)->change();
            $table->string('linfocitos', 25)->nullable(false)->change();
            $table->string('monocitos', 25)->nullable(false)->change();
            $table->string('eosinofilos', 25)->nullable(false)->change();
            $table->string('basofilos', 25)->nullable(false)->change();
            $table->string('recuento_plaquetas', 25)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exm_hemograma_plantillas', function (Blueprint $table) {
            $table->string('globulos_rojos', 25)->nullable()->change();
            $table->string('hemoglobina', 25)->nullable()->change();
            $table->string('hematocrito', 25)->nullable()->change();
            $table->string('vcm', 25)->nullable()->change();
            $table->string('hcm', 25)->nullable()->change();
            $table->string('chcm', 25)->nullable()->change();
            $table->string('leucocitos', 25)->nullable()->change();
            $table->string('neutrofilos_segmentados', 25)->nullable()->change();
            $table->string('neutrofilos_en_banda', 25)->nullable()->change();
            $table->string('linfocitos', 25)->nullable()->change();
            $table->string('monocitos', 25)->nullable()->change();
            $table->string('eosinofilos', 25)->nullable()->change();
            $table->string('basofilos', 25)->nullable()->change();
            $table->string('recuento_plaquetas', 25)->nullable()->change();
        });
    }
};
