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
        Schema::create('exm_generica_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('prueba', 150);
            
            // Parámetros 1 a 5
            for ($i = 1; $i <= 5; $i++) {
                $table->string("param_$i", 100)->nullable();
                $table->string("resultado_$i", 100)->nullable();
                $table->string("unidad_med_$i", 50)->nullable();
                $table->string("rango_ref_$i", 100)->nullable();
            }

            $table->text('observaciones')->nullable();
            
            $table->unsignedBigInteger('examen_id');
            $table->unsignedBigInteger('deta_orden_id');
            
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('restrict');
            $table->foreign('deta_orden_id')->references('id')->on('deta_ordens')->onDelete('cascade');
            
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
        Schema::dropIfExists('exm_generica_plantillas');
    }
};
