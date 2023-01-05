<?php

namespace Database\Factories;

use App\Models\Banners;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banners::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->sentence(10),
            'sub_title' => $this->faker->text(255),
            'photo'     => "https://source.unsplash.com/random/1920x400",
            'url'       => route('all.products'),
            'position'  => $this->faker->randomNumber(2),
            'status'    => 1,
        ];
    }
}
