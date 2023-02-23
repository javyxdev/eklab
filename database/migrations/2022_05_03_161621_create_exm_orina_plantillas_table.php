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
        Schema::create('exm_orina_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('color',25);
            $table->string('aspecto',25);
            $table->string('densidad',25);
            $table->string('ph',25);
            $table->string('proteinas',25);
            $table->string('glucosa',25);
            $table->string('sangre_oculta',25);
            $table->string('cuerpos_cetonicos',25);
            $table->string('urobilinogeo',25);
            $table->string('bilirrubina',25);
            $table->string('nitritos',25);
            $table->string('hemoglobina',25);
            $table->string('eterasa_leucocitaria',25);
            $table->string('hematies',25);
            $table->string('leucocitos',25);
            $table->string('celulas_epiteliales',25);
            $table->string('filamentos_mucoides',25);
            $table->string('bacterias',25);
            $table->string('cil_granulosos',25);
            $table->string('cil_leucocitario',25);
            $table->string('cil_hematicos',25);
            $table->string('cil_hialianos',25);
            $table->string('cil_cereos',25);
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
        Schema::dropIfExists('exm_orina_plantillas');
    }
};
