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
                "name" => "agustin",
                "email" => "agustin@agustin.com",
                "password" => bcrypt('1234a'),
                "rol_id" => 1,
                "nacimiento" => 1982
            ]);


        $antonio =
            User::create([
                "name" => "antonio",
                "email" => "antonio@antonio.com",
                "password" => bcrypt('1234a'),
                "rol_id" => 1,
                "nacimiento" => 2015
            ]);

        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt('1234a'),
            "rol_id" => 2,
            "nacimiento" => 2009
        ]);

        // Amigos
        $agustin = User::where('name', 'agustin')->first();
        $antonio = User::where('name', 'antonio')->first();
        $antonio->users()->attach($agustin->id);

        // Seguimientos
        $pelicula = Audiovisual::find(6);
        $user = User::where('name', 'agustin')->first();
        $user->usuariosSeguimientos()->attach($pelicula->id);
    }
}
