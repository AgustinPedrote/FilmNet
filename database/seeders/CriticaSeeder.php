<?php

namespace Database\Seeders;

use App\Models\Critica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Critica::truncate();

        /* Criticas Agustin */
        Critica::create([
            'critica' => 'Esta serie es increíble, me encantó la trama y los personajes.',
            'user_id' => 1,
            'audiovisual_id' => 13,
        ]);
        Critica::create([
            'critica' => 'Este documental es muy bueno, me encantó la fotografía.',
            'user_id' => 1,
            'audiovisual_id' => 30,
        ]);
        Critica::create([
            'critica' => 'Esta película de animación es maravillosa y tiene un gran final.',
            'user_id' => 1,
            'audiovisual_id' => 10,
        ]);
        Critica::create([
            'critica' => 'Esta película es increíble, me encantó la trama y los personajes.',
            'user_id' => 1,
            'audiovisual_id' => 8,
        ]);

        /* Criticas Antonio */
        Critica::create([
            'critica' => 'Esta serie es increíble, me encantó la trama y los personajes.',
            'user_id' => 2,
            'audiovisual_id' => 13,
        ]);
        Critica::create([
            'critica' => 'Este documental es muy bueno, me encantó la fotografía.',
            'user_id' => 2,
            'audiovisual_id' => 30,
        ]);
        Critica::create([
            'critica' => 'Me ha encantado, creo que es muy recomendable.',
            'user_id' => 2,
            'audiovisual_id' => 11,
        ]);
        Critica::create([
            'critica' => 'No la recomiendo, es muy aburrida.',
            'user_id' => 2,
            'audiovisual_id' => 18,
        ]);

        /* Criticas Maria */
        Critica::create([
            'critica' => 'Esta serie es muy mala, no me gustó la trama ni los personajes.',
            'user_id' => 3,
            'audiovisual_id' => 13,
        ]);
        Critica::create([
            'critica' => 'Este documental es muy entretenido, lo recomiendo.',
            'user_id' => 3,
            'audiovisual_id' => 30,
        ]);
        Critica::create([
            'critica' => 'Esta película de animación es muy bonita y es para todos los públicos.',
            'user_id' => 3,
            'audiovisual_id' => 10,
        ]);
        Critica::create([
            'critica' => 'Esta película es un poco aburrida, no la recomiendo.',
            'user_id' => 3,
            'audiovisual_id' => 8,
        ]);

        /* Criticas Agustin */
        Critica::create([
            'critica' => 'Gran serie para ver una y otra vez.',
            'user_id' => 4,
            'audiovisual_id' => 13,
        ]);
        Critica::create([
            'critica' => 'El documental no es nada entretenido.',
            'user_id' => 4,
            'audiovisual_id' => 30,
        ]);
        Critica::create([
            'critica' => 'Una de las mejores peliculas del año.',
            'user_id' => 4,
            'audiovisual_id' => 10,
        ]);
        Critica::create([
            'critica' => 'No la volveré a ver jamás.',
            'user_id' => 4,
            'audiovisual_id' => 8,
        ]);
    }
}
