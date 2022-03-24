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
        $barrio->descripcion = 'Bo. EL CALVARIO';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. EL CHILE';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. LA SIERPE';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. FATIMA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. EL CENTRO';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. CAJA DE AGUA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. JOYA LENCA';
        $barrio->municipio_id = 1;
        $barrio->save();

        $barrio = new Barrio();
        $barrio->descripcion = 'Bo. SAN ANTONIO';
        $barrio->municipio_id = 1;
        $barrio->save();
    }
}
