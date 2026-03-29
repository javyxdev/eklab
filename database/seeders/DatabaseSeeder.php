<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartamentoSeeder::class,
            MunicipioSeeder::class,
            BarrioSeeder::class,
            CategoriaExamenSeeder::class
            // Agrega aquí todos los seeders que quieras ejecutar
        ]);
    }
}
