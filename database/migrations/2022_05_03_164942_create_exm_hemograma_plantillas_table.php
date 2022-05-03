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
            $table->string('globulos_rojos',25);
            $table->string('hemoglobina',25);
            $table->string('hematocrito',25);
            $table->string('vcm',25);
            $table->string('hcm',25);
            $table->string('chcm',25);
            $table->string('leucocitos',25);
            $table->string('neutrofilos_segmentados',25);
            $table->string('neutrofilos_en_banda',25);
            $table->string('linfocitos',25);
            $table->string('monocitos',25);
            $table->string('eosinofilos',25);
            $table->string('basofilos',25);
            $table->string('recuento_plaquetas',25);
            $table->string('observaciones',300);
            $table->unsignedBigInteger('examen_id');
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
