<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * @test
     * @testdox Test de admin backend pagina zonder authencatie.
     */
    public function indexNoAuth(): void
    {
        $this->get(route('home'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de admin backend home pagina met authenticatie
     */
    public function indexSuccess()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('home'))
            ->assertStatus(200);
    }
}
