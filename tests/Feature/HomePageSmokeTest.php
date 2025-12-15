<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageSmokeTest extends TestCase
{
    /** @test */
    public function home_page_renders_with_main_header_footer_roles()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        // Check for main landmark id and roles added in layout
        $response->assertSee('id="main-content"', false);
        $response->assertSee('role="navigation"', false);
        $response->assertSee('role="contentinfo"', false);
    }
}
