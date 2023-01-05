<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    : array
    {
        $name = $this->faker->unique()->domainWord();
        return [
            'name'   => ucfirst($name),
            'slug'   => Str::slug($name),
            'image'  => "https://source.unsplash.com/random/56x56",
            'banner' => "https://source.unsplash.com/random/1920x310",
            'status' => 1,
        ];
    }
}
