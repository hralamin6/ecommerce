<?php

namespace Database\Seeders;

use App\Models\Wishlists;
use Illuminate\Database\Seeder;

class WishlistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wishlists::factory()
            ->count(5)
            ->create();
    }
}
