<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();
        User::factory()->count(5)->create();
        User::factory()->count(7)->create();
        User::factory()->count(9)->create();
        User::factory()->count(11)->create();
        User::factory()->count(13)->create();
        User::factory()->count(15)->create();
        User::factory()->count(17)->create();
        User::factory()->count(19)->create();
        User::factory()->count(21)->create();
    }
}
