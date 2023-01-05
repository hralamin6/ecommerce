<?php

namespace Database\Factories;

use Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition (): array
    {
        $username = User::first ()->username;
        return [
            'name'              => $this->faker->name (),
            'referral_user'     => $username,
            'username'          => $this->faker->userName (),
            'email'             => $this->faker->email (),
            'phone'             => $this->faker->phoneNumber (),
            'email_verified_at' => now (),
            'password'          => Hash::make ('123456'),
            'remember_token'    => Str::random (10),
            'user_type'         => 'premium',
            'parent_id'         => rand (1, 10),
            'point'             => 5000,
            'balance'           => 0,
            'shipping'          => $this->faker->text (5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified (): Factory
    {
        return $this->state (function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
