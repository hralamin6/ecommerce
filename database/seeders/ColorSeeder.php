<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/colors.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info("Color Table seeded!");
    }
}
