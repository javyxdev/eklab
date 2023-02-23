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
        Schema::create('deta_ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('completado');
            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('examen_id');

            $table->foreign('orden_id')->references('id')->on('ordens')->onDelete('restrict');
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
        Schema::dropIfExists('deta_ordens');
    }
};
