<?php

namespace Database\Seeders;

use App\Models\Audiovisual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $agustin =
            User::create([
                "name" => "agustín",
                "email" => "agustin@agustin.com",
                "password" => bcrypt('1234567a'),
                "rol_id" => 2,
                "nacimiento" => 1982,
                "ciudad" => "Sanlúcar",
                "pais" => "España",
                "sexo" => "hombre"
            ]);

        $antonio =
            User::create([
                "name" => "antonio",
                "email" => "antonio@antonio.com",
                "password" => bcrypt('1234567a'),
                "rol_id" => 1,
                "nacimiento" => 2015,
                "ciudad" => "Las Cabezas",
                "pais" => "España",
                "sexo" => "hombre"
            ]);

        $maria =
            User::create([
                "name" => "María",
                "email" => "maria@maria.com",
                "password" => bcrypt('1234567a'),
                "rol_id" => 1,
                "nacimiento" => 2009,
                "ciudad" => "Barcelona",
                "pais" => "España",
                "sexo" => "mujer"
            ]);

        User::create([
            "name" => "Pastora",
            "email" => "pastora@pastora.com",
            "password" => bcrypt('1234567a'),
            "rol_id" => 1,
            "nacimiento" => 2009,
            "ciudad" => "Galicia",
            "pais" => "España",
            "sexo" => "mujer"
        ]);

        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt('1234567a'),
            "rol_id" => 2,
            "nacimiento" => 2000,
            "ciudad" => "Madrid",
            "pais" => "España",
            "sexo" => "hombre"
        ]);

        // Amigos
        $agustin = User::where('name', 'agustín')->first();
        $antonio = User::where('name', 'antonio')->first();

        $antonio->users()->attach($agustin->id);
        $antonio->users()->attach($maria->id);
        $agustin->users()->attach($antonio->id);
        $agustin->users()->attach($maria->id);

        // Agustin 'Quiero ver'
        $pelicula = Audiovisual::find(6);
        $user = User::where('name', 'agustín')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(10);
        $user = User::where('name', 'agustín')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(12);
        $user = User::where('name', 'agustín')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        // Antonio 'Quiero ver'
        $pelicula = Audiovisual::find(8);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(10);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(13);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(16);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(26);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);

        $pelicula = Audiovisual::find(31);
        $user = User::where('name', 'antonio')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);
    }
}
