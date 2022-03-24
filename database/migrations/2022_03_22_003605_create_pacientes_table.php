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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',150);
            $table->string('apellido',150);
            $table->string('genero',1);
            $table->date('fecha_nacimiento');
            $table->integer('dui')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email',50)->nullable();
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->unsignedBigInteger('barrio_id')->nullable();

            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('restrict');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('restrict');
            $table->foreign('barrio_id')->references('id')->on('barrios')->onDelete('restrict');
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
        Schema::dropIfExists('pacientes');
    }
};
