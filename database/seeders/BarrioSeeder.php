<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barrio = new Barrio();
        $barrio->descripcion = 'EL CALVARIO';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'EL CHILE';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'LA SIERPE';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'FATIMA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'EL CENTRO';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'CAJA DE AGUA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'JOYA LENCA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'SAN ANTONIO';
        $barrio->municipio_id = 1;
        $barrio->save();
    }
}
