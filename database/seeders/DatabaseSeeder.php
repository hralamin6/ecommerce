<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run ()
    {
        // Adding an admin user
        DB::table('users')->insert([
            'name'=>'hr alamin',
            'username'=>'hralamin',
            'email'=>'hralamin2020@gmail.com',
            'user_type'=> 'admin',
            'password'=>Hash::make('000000')
        ]);

        $user = User::create ([
            'name'      => 'OfficialAdmin',
            'username'  => 'officialadmin',
            'email'     => 'b2ebdofficial@gmail.com',
            'password'  => Hash::make (' '),
            'user_type' => 'admin',
        ]);
        $this->call (PermissionsSeeder::class);
//        $this->call(ColorSeeder::class);
        DB::table ('settings')->insert ([
            [ 'key' => 'flash_start' ],
            [ 'key' => 'flash_end' ],
            [ 'key' => 'notice' ],
            [ 'key' => 'inside_dhaka' ],
            [ 'key' => 'outside_dhaka' ],
        ]);
        //required pages for sslcommerz
        DB::table('extra_pages')->insert([
            'id'=>'1'
        ]);

//        $this->call(UserSeeder::class);
        $this->call (CategorySeeder::class);
        $this->call (ColorSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call (DistrictSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(CouponsSeeder::class);
        $this->call(ReviewsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderDetailsSeeder::class);
        $this->call(WishlistsSeeder::class);
        $this->call(BrandSeeder::class);
    }
}
