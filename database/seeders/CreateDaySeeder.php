<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            ['day' => 'Monday', 'day_num' => 1],
            ['day' => 'Tuesday', 'day_num' => 2],
            ['day' => 'Wednesday', 'day_num' => 3],
            ['day' => 'Thursday', 'day_num' => 4],
            ['day' => 'Friday', 'day_num' => 5],
            ['day' => 'Saturday', 'day_num' => 6],
            ['day' => 'Sunday', 'day_num' => 7],
        ]);
    }
}
