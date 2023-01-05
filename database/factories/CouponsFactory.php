<?php

namespace Database\Factories;

use App\Models\Coupons;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupons::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(255),
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'discount_type' => 'percent',
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
        ];
    }
}
