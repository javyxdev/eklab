<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exm_hemograma_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('globulos_rojos',25)->nullable();
            $table->string('hemoglobina',25)->nullable();
            $table->string('hematocrito',25)->nullable();
            $table->string('vcm',25)->nullable();
            $table->string('hcm',25)->nullable();
            $table->string('chcm',25)->nullable();
            $table->string('leucocitos',25)->nullable();
            $table->string('neutrofilos_segmentados',25)->nullable();
            $table->string('neutrofilos_en_banda',25)->nullable();
            $table->string('linfocitos',25)->nullable();
            $table->string('monocitos',25)->nullable();
            $table->string('eosinofilos',25)->nullable();
            $table->string('basofilos',25)->nullable();
            $table->string('recuento_plaquetas',25)->nullable();
            $table->string('observaciones',300)->nullable();
            $table->unsignedBigInteger('examen_id');
            $table->unsignedBigInteger('deta_orden_id');
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exm_hemograma_plantillas');
    }
};
