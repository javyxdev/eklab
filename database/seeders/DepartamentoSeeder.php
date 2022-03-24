<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamento = new Departamento();
        $departamento->descripcion = 'CHALATENANGO';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'SAN SALVADOR';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'LA LIBERTAD';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'SAN VICENTE';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'USULUTAN';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'LA PAZ';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'SANTA ANA';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'SAN MIGUEL';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'LA UNION';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'MORAZAN';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'AHUACHAPAN';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'SONSONATE';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'CABAÑAS';
        $departamento->save();

        $departamento = new Departamento();
        $departamento->descripcion = 'CUSCATLAN';
        $departamento->save();

    }
}
