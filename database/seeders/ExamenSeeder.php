<?php

namespace Database\Seeders;

use App\Models\Examen;
use Illuminate\Database\Seeder;

class ExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $examenes = [
            [
                'id' => 1,
                'descripcion' => 'GLUCOSA AYUNO',
                'precio' => 3.50,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => '70-100',
            ],
            [
                'id' => 2,
                'descripcion' => 'COLESTEROL TOTAL',
                'precio' => 4.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Menor a 200',
            ],
            [
                'id' => 3,
                'descripcion' => 'TRIGLICERIDOS',
                'precio' => 4.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Menor a 150',
            ],
            [
                'id' => 4,
                'descripcion' => 'ACIDO URICO',
                'precio' => 4.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Hombres: 2.4 a 7.0 - Mujeres: 2.4 a 5.7',
            ],
            [
                'id' => 5,
                'descripcion' => 'CREATININA SÉRICA',
                'precio' => 4.50,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Hombres: 0.8 a 1.2 - Mujeres: 0.7 a 1.1',
            ],
            [
                'id' => 6,
                'descripcion' => 'NITROGENO UREICO',
                'precio' => 4.50,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => '8.0 - 23.0',
            ],
            [
                'id' => 7,
                'descripcion' => 'TGO',
                'precio' => 8.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'U/L',
                'rango_ref' => 'Hombres: Menor a 42 - Mujeres: Menor a 32',
            ],
            [
                'id' => 8,
                'descripcion' => 'TGP',
                'precio' => 8.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'U/L',
                'rango_ref' => 'Hombres: Menor a 43 - Mujeres: Menor a 33',
            ],
            [
                'id' => 9,
                'descripcion' => 'COLESTEROL HDL',
                'precio' => 7.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Hombres: Mayor a 55 - Mujeres: Mayor a 65',
            ],
            [
                'id' => 10,
                'descripcion' => 'COLESTEROL LDL',
                'precio' => 7.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mg/dl',
                'rango_ref' => 'Menor a 140',
            ],
            [
                'id' => 11,
                'descripcion' => 'SODIO SERICO',
                'precio' => 7.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mEq/L',
                'rango_ref' => '135 - 155',
            ],
            [
                'id' => 12,
                'descripcion' => 'POTASIO SERICO',
                'precio' => 7.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'mEq/L',
                'rango_ref' => '3.5 - 5.35',
            ],
            [
                'id' => 13,
                'descripcion' => 'FILTRADO GLOMERULAR',
                'precio' => 5.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'ml/min/1.73m2',
                'rango_ref' => '90 - 125',
            ],
            [
                'id' => 14,
                'descripcion' => 'ALBUMINA SERICA',
                'precio' => 7.00,
                'plantilla' => 'QMV',
                'categoria_examen_id' => 1,
                'unidad_med' => 'gr/dl',
                'rango_ref' => 'xxx',
            ],
            [
                'id' => 15,
                'descripcion' => 'HEMOGRAMA + PLAQUETAS',
                'precio' => 7.50,
                'plantilla' => 'HMG',
                'categoria_examen_id' => 2,
                'unidad_med' => null,
                'rango_ref' => null,
            ],
            [
                'id' => 16,
                'descripcion' => 'GENERAL DE ORINA',
                'precio' => 2.25,
                'plantilla' => 'EGO',
                'categoria_examen_id' => 3,
                'unidad_med' => null,
                'rango_ref' => null,
            ],
            [
                'id' => 17,
                'descripcion' => 'GENERAL DE HECES',
                'precio' => 2.25,
                'plantilla' => 'EGH',
                'categoria_examen_id' => 4,
                'unidad_med' => null,
                'rango_ref' => null,
            ],
            [
                'id' => 18,
                'descripcion' => 'HELICOBACTER PYLORI EN HECES',
                'precio' => 20.00,
                'plantilla' => 'GEN',
                'categoria_examen_id' => 7,
                'unidad_med' => null,
                'rango_ref' => null,
            ],
        ];

        foreach ($examenes as $examen) {
            Examen::updateOrCreate(['id' => $examen['id']], $examen);
        }
    }
}
