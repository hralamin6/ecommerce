<?php

    namespace Tests\Feature;

    use Tests\TestCase;
    use App\Models\User;
    use Illuminate\Foundation\Testing\WithFaker;

    class CreatePremiumUser extends TestCase
    {
        use WithFaker;

        /**
         * A basic feature test example.
         *
         * @return void
         */
        public function test_register_user()
        {

        }

        protected function setUp(): void
        {
            parent::setUp();

//        $lastUsername = User::latest()->first()->username;
////        $lastUsername = User::first()->username;
        $this->actingAs(
            User::factory()->create(['username' => $this->faker->userName(), 'user_type' => 'premium', 'referral_user'=> $lastUsername])
        );

            $this->withoutExceptionHandling();
        }
    }
