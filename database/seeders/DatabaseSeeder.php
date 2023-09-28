<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
            PromotionSeeder::class,
            SeatStatusesSeeder::class,
            SeatTypesSeeder::class
        ]);
    }
}
