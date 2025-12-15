<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationAndOrderPagesTest extends TestCase
{
    /** @test */
    public function sign_up_page_loads()
    {
        $response = $this->get(route('customer.auth.sign-up'));
        $response->assertStatus(200);
    }

    /** @test */
    public function order_placed_success_page_loads()
    {
        $response = $this->get(route('order-placed-success'));
        $response->assertStatus(200);
    }

    /** @test */
    public function brands_page_loads()
    {
        $response = $this->get(route('brands'));
        $response->assertStatus(200);
    }

    /** @test */
    public function products_page_loads()
    {
        $response = $this->get(route('products'));
        $response->assertStatus(200);
    }
}
