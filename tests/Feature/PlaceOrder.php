<?php

namespace Tests\Feature;

use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceOrder extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPlaceOrder()
    {

        $add = $this->get("/cart/add-to-cart?id=2&quantity=1&variant=");

        $add->assertStatus(200)
            ->assertJson([
                'message' => true,
            ]);
        $response = $this->post(route('checkout.confirm'), [
            //  "delivery_address" => "Adipisicing repudian"
            //  "postal-code" => "78"
            //  "district" => "Dhaka"
            //  "sub_district" => "422"
            //  "payment_type" => "0"
            //  "payment_from" => null
            //  "trx" => null
            "name" => $this->faker->name(),
            "phone" => $this->faker->e164PhoneNumber(),
            "delivery_address" => $this->faker->address(),
            "district" => "Comilla",
            "sub_district" => "Debidwar",
            "payment_type" => "1",
            "payment_from" => null,
            "trx" => null
        ]);

        $response->assertRedirect(route('shop'))->assertSessionHas('code');
    }

//    public function test_approve_order()
//    {
//        $order = Orders::where('payment_status', 'unpaid')->first()->toArray();
//        $order['payment_status'] = "paid";
//        $update = $this->put(route('all-orders.update', ['orders' => $order['id']]), $order);
//        $update->assertRedirect(route('all-orders.edit', ['orders' => $order['id']]))->assertSessionHas('success');
//
//    }

    protected function setUp(): void
    {
        parent::setUp();

//        $lastUsername = User::latest()->first()->username;
        $lastUsername = User::first()->username;
        $this->actingAs(
//            User::factory()->create(['username' => $this->faker->userName(), 'user_type' => 'premium', 'referral_user'=> $lastUsername, 'point'=>10000])
            User::find(2)
        );

        $this->withoutExceptionHandling();
    }
}
