<?php

namespace Database\Seeders;

use App\Models\Recomendacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecomendacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recomendacion::truncate();

        Recomendacion::create([
            "edad" => "0",
        ]);

        Recomendacion::create([
            "edad" => "13",
        ]);

        Recomendacion::create([
            "edad" => "18",
        ]);
    }
}
