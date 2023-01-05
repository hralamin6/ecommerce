<?php

namespace Database\Factories;

use App\Models\Wishlists;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wishlists::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'products_id' => \App\Models\Products::factory(),
        ];
    }
}
