<?php

namespace Database\Factories;

use App\Models\Reviews;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reviews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->randomNumber(2),
            'comment' => $this->faker->text(5),
            'status' => $this->faker->boolean(),
            'viewed' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
            'products_id' => \App\Models\Products::factory(),
        ];
    }
}
