<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class HomeRouteTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class HomeRouteTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the application index page is accesable.
     */
    public function HomeView(): void
    {
        $this->get(route('home.front'))->assertStatus(200);
    }
}
