<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens', function (Blueprint $table) {
            $table->string('facturado', 2)->default('NO')->after('estado'); // SI, NO
        });

        // Migración de datos: Si el estado era FACTURADO, lo pasamos a operativo (COMPLETADO) y marcamos como facturado SI
        DB::table('ordens')->where('estado', 'FACTURADO')->update([
            'facturado' => 'SI',
            'estado' => 'COMPLETADO' 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir: si facturado era SI, devolvemos el estado a FACTURADO (para mantener compatibilidad con el esquema anterior)
        DB::table('ordens')->where('facturado', 'SI')->update([
            'estado' => 'FACTURADO'
        ]);

        Schema::table('ordens', function (Blueprint $table) {
            $table->dropColumn('facturado');
        });
    }
};
