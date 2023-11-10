<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Audiovisual;
use App\Models\Company;
use App\Models\Genero;
use App\Models\Persona;

class AudiovisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Audiovisual::truncate();

        $pelicula =
        Audiovisual::create([
            "titulo" => "Titanic",
            "titulo_original" => "Titanic",
            "year" => 1997,
            "duracion" => 195,
            "pais" => "Estados Unidos",
            "sinopsis" => "Jack y Rose se enamoran, pero el prometido y la madre de ella ponen todo tipo de trabas a su relación.
            Mientras, el gigantesco y lujoso transatlántico se aproxima hacia un inmenso iceberg.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/titanic-321994924-large.jpg"
        ]);

        $director = Persona::where('nombre', 'James Cameron')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Kate Winslet')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $pelicula =
        Audiovisual::create([
            "titulo" => "Origen",
            "titulo_original" => "Inception",
            "year" => 2010,
            "duracion" => 148,
            "pais" => "Estados Unidos",
            "sinopsis" => "La incepción, que consiste en implantar una idea en el subconsciente en lugar de sustraerla. Sin embargo, su plan se complica.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/inception-652954101-large.jpg"
        ]);

        $director = Persona::where('nombre', 'Christopher Nolan')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hans Zimmer')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Thriller')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Ciencia Ficción')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $pelicula->companies()->attach($company->id);

        $pelicula =
        Audiovisual::create([
            "titulo" => "Saw X",
            "titulo_original" => "Saw 10",
            "year" => 2023,
            "duracion" => 118,
            "pais" => "Estados Unidos",
            "sinopsis" => "Situada entre los acontecimientos sucedidos en SAW y SAW II, John, desesperado y enfermo, viaja a México para someterse a un tratamiento experimental y muy arriesgado con la esperanza de curar su cáncer mortal.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/saw_10-770317273-large.jpg"
        ]);

        $director = Persona::where('nombre', 'Guillermo del Toro')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Wally Pfister')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Sean Bobbitt')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Chris Pine')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Javier Navarrete')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Drama')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Ciencia Ficción')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $pelicula =
        Audiovisual::create([
            "titulo" => "The Marvels",
            "titulo_original" => "The Marvels",
            "year" => 2023,
            "duracion" => 105,
            "pais" => "Estados Unidos",
            "sinopsis" => "JCarol Danvers, alias Capitana Marvel, ha recuperado la identidad que le arrebataron los tiránicos Kree y se ha cobrado su venganza contra la Inteligencia Suprema.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/the_marvels-502364297-large.jpg"
        ]);

        $director = Persona::where('nombre', 'James Cameron')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Kate Winslet')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $pelicula =
        Audiovisual::create([
            "titulo" => "El señor de los anillos: La comunidad del anillo",
            "titulo_original" => "The Lord of the Rings: The Fellowship of the Ring",
            "year" => 2001,
            "duracion" => 180,
            "pais" => "Nueva Zelanda",
            "sinopsis" => "En la Tierra Media, el Señor Oscuro Sauron ordenó a los Elfos que forjaran los Grandes Anillos de Poder.
            Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Pero Saurón también forjó, en secreto, el Anillo Único, que tiene el poder de esclavizar toda la Tierra Media.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/the_lord_of_the_rings_the_fellowship_of_the_ring-952398002-large.jpg"
        ]);

        $director = Persona::where('nombre', 'James Cameron')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Kate Winslet')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $pelicula =
        Audiovisual::create([
            "titulo" => "El chico y la garza",
            "titulo_original" => "Kimitachi wa dô ikiru ka",
            "year" => 2023,
            "duracion" => 124,
            "pais" => "Japón",
            "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.",
            "tipo_id" => 1,
            "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg"
        ]);

        $director = Persona::where('nombre', 'James Cameron')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Kate Winslet')->first();
        $pelicula->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $serie =
        Audiovisual::create([
            "titulo" => "Los Simpson",
            "titulo_original" => "The Simpsons",
            "year" => 1989,
            "duracion" => 22 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Narra la historia de una peculiar familia y otros divertidos personajes de la localidad norteamericana de Springfield.",
            "tipo_id" => 2,
        ]);

        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Álvaro Morte')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        $serie =
        Audiovisual::create([
            "titulo" => "Breaking Bad",
            "titulo_original" => "Breaking Bad",
            "year" => 2008,
            "duracion" => 45 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Walter White, un profesor de química de un instituto de Albuquerque, se entera de que tiene un cáncer de pulmón incurable. Decide, con la ayuda de un antiguo alumno, fabricar anfetaminas y ponerlas a la venta.",
            "tipo_id" => 2,
        ]);

        $director = Persona::where('nombre', 'Vince Gilligan')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Elliot Page')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Dave Porter')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Sophia Lillis')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Aaron Paul')->first();
        $serie->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $serie->companies()->attach($company->id);

        $serie =
        Audiovisual::create([
            "titulo" => "La casa de papel",
            "titulo_original" => "La casa de papel",
            "year" => 2017,
            "duracion" => 70 ,
            "pais" => "España",
            "sinopsis" => "El objetivo es atracar la Fábrica Nacional de Moneda y Timbre, con la intención de quedarse encerrados dentro con una misión muy concreta: no robar dinero, sino crearlo.",
            "tipo_id" => 2,
        ]);

        $director = Persona::where('nombre', 'Álex Pina')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Javier Navarrete')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Alf Clausen')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Úrsula Corberó')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Álvaro Morte')->first();
        $serie->repartos()->attach($reparto->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $serie->companies()->attach($company->id);

        $documental =
        Audiovisual::create([
            "titulo" => "El viaje del emperador",
            "titulo_original" => "La Marche de l'empereur",
            "year" => 2005,
            "duracion" => 85,
            "pais" => "Francia",
            "sinopsis" => "Documental sobre la emigración de los pingüinos en la Antártida.",
            "tipo_id" => 3,
        ]);

        $director = Persona::where('nombre', 'Luc Jacquet')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Ivana Baquero')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $documental =
        Audiovisual::create([
            "titulo" => "Bowling for Columbine",
            "titulo_original" => "Bowling for Columbine",
            "year" => 2002,
            "duracion" => 120 ,
            "pais" => "Estados Unidos",
            "sinopsis" => "Famoso documental que aborda la cuestión de la violencia en América.",
            "tipo_id" => 3,
        ]);

        $director = Persona::where('nombre', 'Michael Moore')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'James Horner')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Michael Moore')->first();
        $documental->guionistas()->attach($guionista->id);

        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $documental =
        Audiovisual::create([
            "titulo" => "Españistán",
            "titulo_original" => "Españistán, de la Burbuja Inmobiliaria a la Crisis",
            "year" => 2011,
            "duracion" => 7,
            "pais" => "España",
            "sinopsis" => "Se basa en el cómic homónimo de Aleix Saló, en el que se analizan las claves de la crisis económica española desde un punto de vista irónico.",
            "tipo_id" => 3,
        ]);

        $director = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Álvaro Morte')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Alf Clausen')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Dave Porter')->first();
        $documental->guionistas()->attach($guionista->id);

        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Comedia')->first();
        $documental->generos()->attach($genero->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);
    }
}
