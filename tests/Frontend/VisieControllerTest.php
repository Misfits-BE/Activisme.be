<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisieControllerTest extends TestCase
{
    /**
     * @test
     * @testdox Test of men de visie pagina kan bekijken zonder fouten.
     */
    public function index(): void
    {
        $this->get(route('visie.index'))
            ->assertStatus(200);
    }
}
