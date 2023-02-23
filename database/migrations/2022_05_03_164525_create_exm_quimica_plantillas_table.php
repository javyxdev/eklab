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
        Schema::create('exm_quimica_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('prueba',50);
            $table->string('resultado',75);
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
        Schema::dropIfExists('exm_quimica_plantillas');
    }
};
