<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seat_types')->insert([
            'title' => 'Common',
            'price' => 9.9
        ]);
        DB::table('seat_types')->insert([
            'title' => 'VIP',
            'price' => 15.2
        ]);
    }
}
