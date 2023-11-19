<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(RecomendacionSeeder::class);
        $this->call(AudiovisualSeeder::class);
        $this->call(PremioSeeder::class);
        $this->call(UserSeeder::class);
    }
}
