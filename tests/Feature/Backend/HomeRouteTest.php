<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class HomeRouteTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Backend
 */
class HomeRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test if an unauthenticated user can't access the home index page.
     */
    public function unAuthenticated(): void
    {
        $this->get(route('home'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if a authenticated user can view the home index page.
     */
    public function authenticated(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertStatus(200);
    }
}
