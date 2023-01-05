<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->sentence(4),
            'action' => route('all.categories'),
            'image' => "https://source.unsplash.com/random/1920x600",
            'status' => 1,
        ];
    }
}
