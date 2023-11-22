<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::truncate();

        Company::create([
            "nombre" => "Marvel Studios",
        ]);

        Company::create([
            "nombre" => "Walt Disney Pictures",
        ]);

        Company::create([
            "nombre" => "Paramount Pictures",
        ]);

        Company::create([
            "nombre" => "20th Century Fox",
        ]);

        Company::create([
            "nombre" => "Lightstorm Entertainments",
        ]);

        Company::create([
            "nombre" => "Studio Ghibli",
        ]);
    }
}
