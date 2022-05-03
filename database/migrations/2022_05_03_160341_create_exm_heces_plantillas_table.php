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
        Schema::create('exm_heces_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('color',25);
            $table->string('consistencia',25);
            $table->string('mucus',25);
            $table->string('restos_alim_mac',25);
            $table->string('sangre',25);
            $table->string('leucocitos',25);
            $table->string('hematies',25);
            $table->string('levadura',25);
            $table->string('restos_alim_mic',25);
            $table->string('parasitos',150);
            $table->string('observaciones',300)->nullable();
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
        Schema::dropIfExists('exm_heces_plantillas');
    }
};
