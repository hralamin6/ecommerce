<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(255),
            'shipping_address' => $this->faker->text(5),
            'delivery_status' => 'ordered',
            'payment_type' => 'cash on delivery',
            'payment_status' => 'unpaid',
            'grand_total' => $this->faker->randomNumber(2),
            'coupon_discount' => $this->faker->randomNumber(2),
            'viewed' => $this->faker->boolean(),
            'commission' => $this->faker->randomNumber(2),
            'shipping_cost' => $this->faker->randomNumber(2),
            'shipping_district' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
