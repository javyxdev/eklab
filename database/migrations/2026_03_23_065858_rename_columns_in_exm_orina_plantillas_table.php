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
        Schema::table('exm_orina_plantillas', function (Blueprint $table) {
            $table->renameColumn('urobilinogeo', 'urobilinogeno');
            $table->renameColumn('eterasa_leucocitaria', 'esterasa_leucocitaria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exm_orina_plantillas', function (Blueprint $table) {
            $table->renameColumn('urobilinogeno', 'urobilinogeo');
            $table->renameColumn('esterasa_leucocitaria', 'eterasa_leucocitaria');
        });
    }
};
