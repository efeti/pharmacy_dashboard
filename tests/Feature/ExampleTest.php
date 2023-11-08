<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        dump('hello');
    }

    public function test_request(){
        $this->withoutMiddleware([VerifyCsrfToken::class])->post(route('add_product_submit'), [
            'name' => 'panadol', 'quantity' => 3, 'unit_price' => 5 
        ])->dump();
    }
}
