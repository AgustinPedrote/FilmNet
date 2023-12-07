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
                "rol_id" => 1,
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

        User::create([
            "name" => "María",
            "email" => "maria@maria.com",
            "password" => bcrypt('1234567a'),
            "rol_id" => 2,
            "nacimiento" => 2009,
            "ciudad" => "Barcelona",
            "pais" => "España",
            "sexo" => "mujer"
        ]);

        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt('1234567a'),
            "rol_id" => 2,
            "nacimiento" => 2009,
            "ciudad" => "Madrid",
            "pais" => "España",
            "sexo" => "hombre"
        ]);

        // Amigos
        $agustin = User::where('name', 'agustín')->first();
        $antonio = User::where('name', 'antonio')->first();
        $antonio->users()->attach($agustin->id);

        // Seguimientos
        $pelicula = Audiovisual::find(6);
        $user = User::where('name', 'agustín')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);
    }
}
