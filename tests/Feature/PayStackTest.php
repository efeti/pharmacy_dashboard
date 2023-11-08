<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Unicodeveloper\Paystack\Paystack;

class PayStackTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_paystack_url()
    {
        $data = (new Paystack)->getAuthorizationResponse([
            'amount' => 100 * 100,
            'reference' => \Illuminate\Support\Str::uuid(),
            'email' => $this->faker->email,
            'currency' => 'NGN',
            'orderID' => $this->faker->numerify('#######')
        ]);

        dump($data);
    }
}
