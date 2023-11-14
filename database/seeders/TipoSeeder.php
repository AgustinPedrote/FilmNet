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
            "nombre" => "Película",
        ]);

        Tipo::create([
            "nombre" => "Serie",
        ]);

        Tipo::create([
            "nombre" => "Documental",
        ]);
    }
}
