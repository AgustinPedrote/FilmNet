<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genero::truncate();

        Genero::create([
            "nombre" => "Acción",
        ]);

        Genero::create([
            "nombre" => "Animación",
        ]);

        Genero::create([
            "nombre" => "Aventuras",
        ]);

        Genero::create([
            "nombre" => "Bélico",
        ]);

        Genero::create([
            "nombre" => "Ciencia Ficción",
        ]);

        Genero::create([
            "nombre" => "Comedia",
        ]);

        Genero::create([
            "nombre" => "Drama",
        ]);

        Genero::create([
            "nombre" => "Infantil",
        ]);

        Genero::create([
            "nombre" => "Intriga",
        ]);

        Genero::create([
            "nombre" => "Musical",
        ]);

        Genero::create([
            "nombre" => "Romance",
        ]);

        Genero::create([
            "nombre" => "Terror",
        ]);

        Genero::create([
            "nombre" => "Thriller",
        ]);

        Genero::create([
            "nombre" => "Western",
        ]);

        Genero::create([
            "nombre" => "Superhéroes",
        ]);
    }
}
