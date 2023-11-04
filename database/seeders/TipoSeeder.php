<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo;


class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo::truncate();

        Tipo::create([
            "nombre" => "Películas",
        ]);

        Tipo::create([
            "nombre" => "Series",
        ]);

        Tipo::create([
            "nombre" => "Documentales",
        ]);
    }
}
