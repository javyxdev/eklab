<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municipio = new Municipio();
        $municipio->descripcion = 'CHALATENANGO';
        $municipio->departamento_id = 2;
        $municipio->save();

        $municipio2 = new Municipio();
        $municipio2->descripcion = 'CONCEPCION QUEZALTEPEQUE';
        $municipio2->departamento_id = 2;
        $municipio2->save();

        $municipio3 = new Municipio();
        $municipio3->descripcion = 'LA REINA';
        $municipio3->departamento_id = 2;
        $municipio3->save();

        $municipio4 = new Municipio();
        $municipio4->descripcion = 'OJOS DE AGUA';
        $municipio4->departamento_id = 2;
        $municipio4->save();

        $municipio5 = new Municipio();
        $municipio5->descripcion = 'NUEVA CONCEPCION';
        $municipio5->departamento_id = 2;
        $municipio5->save();

        $municipio6 = new Municipio();
        $municipio6->descripcion = 'AGUA CALIENTE';
        $municipio6->departamento_id = 2;
        $municipio6->save();

        $municipio7 = new Municipio();
        $municipio7->descripcion = 'OJOS DE AGUA';
        $municipio7->departamento_id = 2;
        $municipio7->save();

        $municipio8 = new Municipio();
        $municipio8->descripcion = 'SAN SALVADOR';
        $municipio8->departamento_id = 3;
        $municipio8->save();



    }
}
