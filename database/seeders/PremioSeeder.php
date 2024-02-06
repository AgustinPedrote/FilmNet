<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Premio;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Premio::truncate();

        Premio::create([
            "nombre" => "Oscar",
            "year" => "1997",
            "audiovisual_id" => 1,
        ]);

        Premio::create([
            "nombre" => "Emmy",
            "year" => "1989",
            "audiovisual_id" => 4,
        ]);

        Premio::create([
            "nombre" => "National Board of Review",
            "year" => "2005",
            "audiovisual_id" => 7,
        ]);


        Premio::create([
            "nombre" => "Globos de Oro",
            "year" => "2008",
            "audiovisual_id" => 13,
        ]);

        Premio::create([
            "nombre" => "BAFTA",
            "year" => "2020",
            "audiovisual_id" => 24,
        ]);

        Premio::create([
            "nombre" => "Goya",
            "year" => "2023",
            "audiovisual_id" => 32,
        ]);
    }
}
