<?php

namespace Database\Seeders;

use App\Models\Categoria_examen;
use Illuminate\Database\Seeder;

class CategoriaExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'QUIMICA CLINICA',
            'HEMATOLOGIA',
            'URIANALISIS',
            'COPROLOGIA',
            'BACTERIOLOGIA',
            'COAGULACION',
            'PRUEBAS ESPECIALES',
            'INMUNOLOGIA'
        ];

        foreach ($categorias as $descripcion) {
            Categoria_examen::create([
                'descripcion' => $descripcion
            ]);
        }
    }
}
