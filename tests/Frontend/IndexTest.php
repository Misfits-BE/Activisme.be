<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    /**
     * @test
     * @testdox Test of men de front pagina kan bekijken zonder fouten.
     */
    public function index(): void
    {
        $this->get(route('home.front'))
            ->assertStatus(200);
    }
}
