<?php

namespace Database\Seeders;

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

        User::create([
            "name" => "agustin",
            "email" => "agustin@agustin.com",
            "password" => bcrypt('12345678'),
            "rol_id" => 1,
        ]);

        User::create([
            "name" => "antonio",
            "email" => "antonio@antonio.com",
            "password" => bcrypt('12345678'),
            "rol_id" => 1,
        ]);

        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt('12345678'),
            "rol_id" => 2,
        ]);
    }
}
