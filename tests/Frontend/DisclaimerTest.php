<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Test als de gast de disclaimer kan bekijken zonder fouten.
     */
    public function index(): void
    {
        $this->get(route('disclaimer.index'))
            ->assertStatus(200);
    }
}
