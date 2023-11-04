<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Audiovisual;

class AudiovisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Audiovisual::truncate();

        Audiovisual::create([
            "titulo" => "Titanic",
            "titulo_original" => "Titanic",
            "year" => 1997,
            "duracion" => 195,
            "pais" => "Estados Unidos",
            "sinopsis" => "Jack y Rose se enamoran, pero el prometido y la madre de ella ponen todo tipo de trabas a su relación.
            Mientras, el gigantesco y lujoso transatlántico se aproxima hacia un inmenso iceberg.",
            "tipo_id" => 1,
        ]);

        Audiovisual::create([
            "titulo" => "Origen",
            "titulo_original" => "Inception",
            "year" => 2010,
            "duracion" => 148,
            "pais" => "Estados Unidos",
            "sinopsis" => "La incepción, que consiste en implantar una idea en el subconsciente en lugar de sustraerla. Sin embargo, su plan se complica.",
            "tipo_id" => 1,
        ]);

        Audiovisual::create([
            "titulo" => "El laberinto del fauno",
            "titulo_original" => "El laberinto del fauno",
            "year" => 2006,
            "duracion" => 112,
            "pais" => "España",
            "sinopsis" => "Juna extraña criatura que le hace una sorprendente revelación: ella es en realidad una princesa, la última de su estirpe, y los suyos la esperan desde hace mucho tiempo.",
            "tipo_id" => 1,
        ]);

        Audiovisual::create([
            "titulo" => "Los Simpson",
            "titulo_original" => "The Simpsons",
            "year" => 1989,
            "duracion" => 22 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Narra la historia de una peculiar familia y otros divertidos personajes de la localidad norteamericana de Springfield.",
            "tipo_id" => 2,
        ]);

        Audiovisual::create([
            "titulo" => "Breaking Bad",
            "titulo_original" => "Breaking Bad",
            "year" => 2008,
            "duracion" => 45 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Walter White, un profesor de química de un instituto de Albuquerque, se entera de que tiene un cáncer de pulmón incurable. Decide, con la ayuda de un antiguo alumno, fabricar anfetaminas y ponerlas a la venta.",
            "tipo_id" => 2,
        ]);

        Audiovisual::create([
            "titulo" => "La casa de papel",
            "titulo_original" => "La casa de papel",
            "year" => 2017,
            "duracion" => 70 ,
            "pais" => "España",
            "sinopsis" => "El objetivo es atracar la Fábrica Nacional de Moneda y Timbre, con la intención de quedarse encerrados dentro con una misión muy concreta: no robar dinero, sino crearlo.",
            "tipo_id" => 2,
        ]);

        Audiovisual::create([
            "titulo" => "El viaje del emperador",
            "titulo_original" => "La Marche de l'empereur",
            "year" => 2005,
            "duracion" => 85,
            "pais" => "Francia",
            "sinopsis" => "Documental sobre la emigración de los pingüinos en la Antártida.",
            "tipo_id" => 3,
        ]);

        Audiovisual::create([
            "titulo" => "Bowling for Columbine",
            "titulo_original" => "Bowling for Columbine",
            "year" => 2002,
            "duracion" => 120 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Famoso documental que aborda la cuestión de la violencia en América.",
            "tipo_id" => 3,
        ]);

        Audiovisual::create([
            "titulo" => "Españistán",
            "titulo_original" => "Españistán, de la Burbuja Inmobiliaria a la Crisis",
            "year" => 2011,
            "duracion" => 7,
            "pais" => "España",
            "sinopsis" => "Se basa en el cómic homónimo de Aleix Saló, en el que se analizan las claves de la crisis económica española desde un punto de vista irónico.",
            "tipo_id" => 3,
        ]);
    }
}
