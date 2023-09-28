<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seat_statuses')->insert([
            'title' => 'N/A'
        ]);
        DB::table('seat_statuses')->insert([
            'title' => 'Selected'
        ]);
        DB::table('seat_statuses')->insert([
            'title' => 'Occupied'
        ]);
    }
}
