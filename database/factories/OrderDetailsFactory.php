<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'quantity' => $this->faker->randomNumber(2),
            'orders_id' => \App\Models\Orders::factory(),
            'products_id' => \App\Models\Products::factory(),
        ];
    }
}
