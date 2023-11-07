<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;


class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::truncate();

        Persona::create([
            "nombre" => "James Cameron",
        ]);

        Persona::create([
            "nombre" => "James Horner",
        ]);

        Persona::create([
            "nombre" => "Russell Carpenter",
        ]);

        Persona::create([
            "nombre" => "Leonardo DiCaprio",
        ]);

        Persona::create([
            "nombre" => "Kate Winslet",
        ]);

        Persona::create([
            "nombre" => "Christopher Nolan",
        ]);

        Persona::create([
            "nombre" => "Hans Zimmer",
        ]);

        Persona::create([
            "nombre" => "Wally Pfister",
        ]);

        Persona::create([
            "nombre" => "Joseph Gordon-Levitt",
        ]);

        Persona::create([
            "nombre" => "Elliot Page",
        ]);

        Persona::create([
            "nombre" => "Guillermo del Toro",
        ]);

        Persona::create([
            "nombre" => "Javier Navarrete",
        ]);

        Persona::create([
            "nombre" => "Guillermo Navarro",
        ]);

        Persona::create([
            "nombre" => "Ivana Baquero",
        ]);

        Persona::create([
            "nombre" => "Maribel Verdú",
        ]);

        Persona::create([
            "nombre" => "Matt Groening",
        ]);

        Persona::create([
            "nombre" => "Dan Castellaneta",
        ]);

        Persona::create([
            "nombre" => "Hank Azaria",
        ]);

        Persona::create([
            "nombre" => "Alf Clausen",
        ]);

        Persona::create([
            "nombre" => "Vince Gilligan",
        ]);

        Persona::create([
            "nombre" => "Bryan Cranston",
        ]);

        Persona::create([
            "nombre" => "Aaron Paul",
        ]);

        Persona::create([
            "nombre" => "Dave Porter",
        ]);

        Persona::create([
            "nombre" => "Álex Pina",
        ]);

        Persona::create([
            "nombre" => "Álvaro Morte",
        ]);

        Persona::create([
            "nombre" => "Úrsula Corberó",
        ]);

        Persona::create([
            "nombre" => "Luc Jacquet",
        ]);

        Persona::create([
            "nombre" => "Michael Moore",
        ]);

        Persona::create([
            "nombre" => "Aleix Saló",
        ]);

        Persona::create([
            "nombre" => "Álvaro Morte",
        ]);

        Persona::create([
            "nombre" => "Laura Karpman",
        ]);

        Persona::create([
            "nombre" => "Sean Bobbitt",
        ]);

        Persona::create([
            "nombre" => "Nia DaCosta",
        ]);

        Persona::create([
            "nombre" => "Samuel L. Jackson",
        ]);

        Persona::create([
            "nombre" => "Lorne Balfe",
        ]);

        Persona::create([
            "nombre" => "Barry Peterson",
        ]);

        Persona::create([
            "nombre" => "Chris Pine",
        ]);

        Persona::create([
            "nombre" => "Michelle Rodriguez",
        ]);

        Persona::create([
            "nombre" => "Justice Smith",
        ]);

        Persona::create([
            "nombre" => "Hugh Grant",
        ]);

        Persona::create([
            "nombre" => "Sophia Lillis",
        ]);
    }
}
