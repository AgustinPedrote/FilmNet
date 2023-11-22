<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Audiovisual;
use App\Models\Company;
use App\Models\Genero;
use App\Models\Persona;
use App\Models\User;

class AudiovisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se truncan los datos en la tabla Audiovisual para evitar duplicados
        Audiovisual::truncate();

        // Creación de la película "Titanic"
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
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/titanic-321994924-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
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

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "Origen"
        $pelicula =
            Audiovisual::create([
                "titulo" => "Origen",
                "titulo_original" => "Inception",
                "year" => 2010,
                "duracion" => 148,
                "pais" => "Estados Unidos",
                "sinopsis" => "La incepción, que consiste en implantar una idea en el subconsciente en lugar de sustraerla. Sin embargo, su plan se complica.",
                "tipo_id" => 1,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/inception-652954101-large.jpg",
                "trailer" => "https://www.youtube.com/embed/RV9L7ui9Cn8?si=2Znoq3jRJWmNwVX9"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Christopher Nolan')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hans Zimmer')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Alf Clausen')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Sean Bobbitt')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Leonardo DiCaprio')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Thriller')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Ciencia Ficción')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "Saw X"
        $pelicula =
            Audiovisual::create([
                "titulo" => "Saw X",
                "titulo_original" => "Saw 10",
                "year" => 2023,
                "duracion" => 118,
                "pais" => "Estados Unidos",
                "sinopsis" => "Situada entre los acontecimientos sucedidos en SAW y SAW II, John, desesperado y enfermo, viaja a México para someterse a un tratamiento experimental y muy arriesgado con la esperanza de curar su cáncer mortal.",
                "tipo_id" => 1,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/saw_10-770317273-large.jpg",
                "trailer" => "https://www.youtube.com/embed/acQco_ggW1o?si=Yx4j6WmP3MajyQ-K"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Guillermo del Toro')->first();
        $pelicula->directores()->attach($director->id);

        $director = Persona::where('nombre', 'Nia DaCosta')->first();
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

        $reparto = Persona::where('nombre', 'Samuel L. Jackson')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Ciencia Ficción')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "The Marvels"
        $pelicula =
            Audiovisual::create([
                "titulo" => "The Marvels",
                "titulo_original" => "The Marvels",
                "year" => 2023,
                "duracion" => 105,
                "pais" => "Estados Unidos",
                "sinopsis" => "JCarol Danvers, alias Capitana Marvel, ha recuperado la identidad que le arrebataron los tiránicos Kree y se ha cobrado su venganza contra la Inteligencia Suprema.",
                "tipo_id" => 1,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/the_marvels-502364297-large.jpg",
                "trailer" => "https://www.youtube.com/embed/gdSGIf8kbhg?si=7V7xYQ2Uyfcj68Xq"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Sean Bobbitt')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Chris Pine')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Hugh Grant')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Luc Jacquet')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Acción')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        $company = Company::where('nombre', 'Marvel Studios')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El señor de los anillos"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El señor de los anillos",
                "titulo_original" => "The Lord of the Rings: The Fellowship of the Ring",
                "year" => 2001,
                "duracion" => 180,
                "pais" => "Nueva Zelanda",
                "sinopsis" => "En la Tierra Media, el Señor Oscuro Sauron ordenó a los Elfos que forjaran los Grandes Anillos de Poder.
            Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Pero Saurón también forjó, en secreto, el Anillo Único, que tiene el poder de esclavizar toda la Tierra Media.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_lord_of_the_rings_the_fellowship_of_the_ring-952398002-large.jpg",
                "trailer" => "https://www.youtube.com/embed/3GJp6p_mgPo?si=YsDcwOivvfxrixXA"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Peter Jackson')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Russell Carpenter')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Justice Smith')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Elijah Wood')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Kate Winslet')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Ciencia Ficción')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la película "El chico y la garza"
        $pelicula =
            Audiovisual::create([
                "titulo" => "El chico y la garza",
                "titulo_original" => "Kimitachi wa dô ikiru ka",
                "year" => 2023,
                "duracion" => 124,
                "pais" => "Japón",
                "sinopsis" => "Mahito, un joven de 12 años, lucha por asentarse en una nueva ciudad tras la muerte de su madre.
                Sin embargo, cuando una garza parlante informa a Mahito de que su madre sigue viva, entra en una torre abandonada en su busca, lo que le lleva a otro mundo.
                El título de la película se basa en la novela de 1937, 'Kimitachi wa Dō Ikiru ka' escrita por Yoshino Genzaburō pero la película presenta una historia original que no guarda relación con la novela.",
                "tipo_id" => 1,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/kimitachi_wa_do_ikiru_ka-917153869-large.jpg",
                "trailer" => "https://www.youtube.com/embed/oDIbOWgADr8?si=mEBLLW0kjVAtXtBI"
            ]);

        // Se obtienen las personas relacionadas con la película (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->compositores()->attach($compositor->id);

        $compositor = Persona::where('nombre', 'Barry Peterson')->first();
        $pelicula->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Álvaro Morte')->first();
        $pelicula->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Hayao Miyazaki')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Lorne Balfe')->first();
        $pelicula->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Nia DaCosta')->first();
        $pelicula->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Laura Karpman')->first();
        $pelicula->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Romance')->first();
        $pelicula->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $pelicula->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $pelicula->companies()->attach($company->id);

        // Creación de la serie "Los Simpson"
        $serie =
            Audiovisual::create([
                "titulo" => "Los Simpson",
                "titulo_original" => "The Simpsons",
                "year" => 1989,
                "duracion" => 22,
                "pais" => "Estados Unidos",
                "sinopsis" => "Narra la historia de una peculiar familia y otros divertidos personajes de la localidad norteamericana de Springfield.",
                "tipo_id" => 2,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_simpsons-397676780-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
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

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Studio Ghibli')->first();
        $serie->companies()->attach($company->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Breaking Bad"
        $serie =
            Audiovisual::create([
                "titulo" => "Breaking Bad",
                "titulo_original" => "Breaking Bad",
                "year" => 2008,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Walter White, un profesor de química de un instituto de Albuquerque, se entera de que tiene un cáncer de pulmón incurable. Decide, con la ayuda de un antiguo alumno, fabricar anfetaminas y ponerlas a la venta.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/breaking_bad-504442815-large.jpg",
                "trailer" => "https://www.youtube.com/embed/V8WQhxHEmMc?si=5xwqF596r_2AFaOX"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Vince Gilligan')->first();
        $serie->directores()->attach($director->id);

        $director = Persona::where('nombre', 'Hank Azaria')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Elliot Page')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Dave Porter')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Sophia Lillis')->first();
        $serie->guionistas()->attach($guionista->id);

        $guionista = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Aaron Paul')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Alf Clausen')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Drama')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "La casa de papel"
        $serie =
            Audiovisual::create([
                "titulo" => "La casa de papel",
                "titulo_original" => "La casa de papel",
                "year" => 2017,
                "duracion" => 70,
                "pais" => "España",
                "sinopsis" => "El objetivo es atracar la Fábrica Nacional de Moneda y Timbre, con la intención de quedarse encerrados dentro con una misión muy concreta: no robar dinero, sino crearlo.",
                "tipo_id" => 2,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/la_casa_de_papel-844739080-large.jpg",
                "trailer" => "https://www.youtube.com/embed/3y-6iaveY6c?si=sHB3JWOZYPOxBOGx"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
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

        $reparto = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $serie->companies()->attach($company->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "The Last of Us"
        $serie =
            Audiovisual::create([
                "titulo" => "The Last of Us",
                "titulo_original" => "The Last of Us",
                "year" => 2023,
                "duracion" => 50,
                "pais" => "Estados Unidos",
                "sinopsis" => "Veinte años después de la destrucción de la civilización moderna a causa de un hongo que se adueña del cuerpo de los humanos, uno de los supervivientes, recibe el encargo de sacar a la joven Ellie de una opresiva zona de cuarentena.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/the_last_of_us-722385305-large.jpg",
                "trailer" => "https://www.youtube.com/embed/yyGetSp7CIc?si=G_lRU4yeLwaDghuv"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Elliot Page')->first();
        $serie->directores()->attach($director->id);

        $director = Persona::where('nombre', 'Sean Bobbitt')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Alf Clausen')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Pedro Pascal')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Álvaro Morte')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Lorne Balfe')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Terror')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "La Casa del Dragón"
        $serie =
            Audiovisual::create([
                "titulo" => "La Casa del Dragón",
                "titulo_original" => "House of the Dragon",
                "year" => 2022,
                "duracion" => 60,
                "pais" => "Estados Unidos",
                "sinopsis" => "Historia ambientada 172 años antes de Daenerys Targaryen, y en el noveno año del reinado de Viserys Targaryen (Paddy Considine), un rey cuya línea de sucesión está en peligro.",
                "tipo_id" => 2,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/house_of_the_dragon-678918948-large.jpg",
                "trailer" => "https://www.youtube.com/embed/339paLFRKlo?si=u21ATdi0o1jfYLoz"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Lorne Balfe')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Sean Bobbitt')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Dave Porter')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Wally Pfister')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);

        // Creación de la serie "Invencible"
        $serie =
            Audiovisual::create([
                "titulo" => "Invencible",
                "titulo_original" => "Invincible",
                "year" => 2021,
                "duracion" => 45,
                "pais" => "Estados Unidos",
                "sinopsis" => "Cuando Mark Grayson hereda superpoderes con 17 años, se convierte en uno de los superhéroes más grandes de la Tierra, junto con su padre.",
                "tipo_id" => 2,
                "recomendacion_id" => 3,
                "img" => "https://pics.filmaffinity.com/invincible-253390708-large.jpg",
                "trailer" => "https://www.youtube.com/embed/VuK_xTa6QTI?si=Ft1U8OgE-razNHqK"
            ]);

        // Se obtienen las personas relacionadas con la serie (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Matt Groening')->first();
        $serie->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Dan Castellaneta')->first();
        $serie->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Nia DaCosta')->first();
        $serie->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Justice Smith')->first();
        $serie->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Bryan Cranston')->first();
        $serie->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Guillermo Navarro')->first();
        $serie->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Animación')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $serie->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Acción')->first();
        $serie->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', '20th Century Fox')->first();
        $serie->companies()->attach($company->id);


        // Creación del documental "Pelé"
        $documental =
            Audiovisual::create([
                "titulo" => "Pelé",
                "titulo_original" => "Pelé",
                "year" => 2021,
                "duracion" => 108,
                "pais" => "Reino Unido",
                "sinopsis" => "Documental de Netflix que narra la vida del futbolista Edson Arantes do Nascimento, más conocido como Pelé.",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/pele-801713591-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Luc Jacquet')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Ivana Baquero')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Pelé')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Romance')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Studio Ghibli')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "Bowling for Columbine"
        $documental =
            Audiovisual::create([
                "titulo" => "Bowling for Columbine",
                "titulo_original" => "Bowling for Columbine",
                "year" => 2002,
                "duracion" => 120,
                "pais" => "Estados Unidos",
                "sinopsis" => "Famoso documental que aborda la cuestión de la violencia en América.",
                "tipo_id" => 3,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/bowling_for_columbine-349496940-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michael Moore')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'James Horner')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Joseph Gordon-Levitt')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Michael Moore')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Michael Moore')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', '20th Century Fox')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "Cowspiracy: The Sustainability Secret"
        $documental =
            Audiovisual::create([
                "titulo" => "Cowspiracy",
                "titulo_original" => "Cowspiracy: The Sustainability Secret",
                "year" => 2014,
                "duracion" => 91,
                "pais" => "Estados Unidos",
                "sinopsis" => "Las organizaciones ecologistas más importantes a nivel mundial están fracasando al encarar la fuerza destructiva más grande a la que se enfrenta hoy nuestro planeta.",
                "tipo_id" => 3,
                "recomendacion_id" => 2,
                "img" => "https://pics.filmaffinity.com/cowspiracy_the_sustainability_secret-329537261-large.jpg",
                "trailer" => "https://www.youtube.com/embed/QQ0a4z8_F8s?si=zTou1QlPvCyBYGXS"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Álvaro Morte')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Alf Clausen')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Dave Porter')->first();
        $documental->guionistas()->attach($guionista->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Comedia')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El dilema de las redes sociales"
        $documental =
            Audiovisual::create([
                "titulo" => "El dilema de las redes sociales",
                "titulo_original" => "The Social Dilemma",
                "year" => 2020,
                "duracion" => 93,
                "pais" => "Estados Unidos",
                "sinopsis" => "Los maestros de la tecnología han ideado una nueva forma de capitalismo, y la humanidad es ahora la materia prima de la que se alimentan las máquinas.",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_social_dilemma-384147385-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Luc Jacquet')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Sean Bobbitt')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->guionistas()->attach($guionista->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "Lo que el pulpo me enseñó"
        $documental =
            Audiovisual::create([
                "titulo" => "Lo que el pulpo me enseñó",
                "titulo_original" => "My Octopus Teacher",
                "year" => 2020,
                "duracion" => 85,
                "pais" => "Sudáfrica",
                "sinopsis" => "Un cineasta forja una amistad inusual con un pulpo que vive en un bosque de algas en Sudáfrica y aprende mientras el animal comparte los misterios de su mundo.",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/my_octopus_teacher-902842067-large.jpg",
                "trailer" => "https://www.youtube.com/embed/1HBKCE8j7EQ?si=gKVmmxro2rWu8ZPJ"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Laura Karpman')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Ivana Baquero')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Sophia Lillis')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Marvel Studios')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);

        // Creación del documental "El equipo redentor"
        $documental =
            Audiovisual::create([
                "titulo" => "El equipo redentor",
                "titulo_original" => "The Redeem Team",
                "year" => 2022,
                "duracion" => 97,
                "pais" => "Estados Unidos",
                "sinopsis" => "Después de su decepcionante actuación en los Juegos Olímpicos de 2004, el equipo masculino de baloncesto de Estados Unidos busca la redención persiguiendo el oro en Pekín 2008. ",
                "tipo_id" => 3,
                "recomendacion_id" => 1,
                "img" => "https://pics.filmaffinity.com/the_redeem_team-367062472-large.jpg"
            ]);

        // Se obtienen las personas relacionadas con el documental (director, compositor, fotógrafo, guionista, reparto)
        $director = Persona::where('nombre', 'Michelle Rodriguez')->first();
        $documental->directores()->attach($director->id);

        $compositor = Persona::where('nombre', 'Úrsula Corberó')->first();
        $documental->compositores()->attach($compositor->id);

        $fotografia = Persona::where('nombre', 'Hank Azaria')->first();
        $documental->fotografias()->attach($fotografia->id);

        $fotografia = Persona::where('nombre', 'Aleix Saló')->first();
        $documental->fotografias()->attach($fotografia->id);

        $guionista = Persona::where('nombre', 'Nia DaCosta')->first();
        $documental->guionistas()->attach($guionista->id);

        $reparto = Persona::where('nombre', 'Barry Peterson')->first();
        $documental->repartos()->attach($reparto->id);

        $reparto = Persona::where('nombre', 'Brie Larson')->first();
        $documental->repartos()->attach($reparto->id);

        // Se obtiene los géneros.
        $genero = Genero::where('nombre', 'Drama')->first();
        $documental->generos()->attach($genero->id);

        $genero = Genero::where('nombre', 'Aventuras')->first();
        $documental->generos()->attach($genero->id);

        // Se obtienen las compañias.
        $company = Company::where('nombre', 'Walt Disney Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Paramount Pictures')->first();
        $documental->companies()->attach($company->id);

        $company = Company::where('nombre', 'Lightstorm Entertainments')->first();
        $documental->companies()->attach($company->id);
    }
}
