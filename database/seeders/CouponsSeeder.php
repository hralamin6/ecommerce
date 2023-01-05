<?php

namespace Database\Seeders;

use App\Models\Coupons;
use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupons::factory()
            ->count(5)
            ->create();
    }
}
