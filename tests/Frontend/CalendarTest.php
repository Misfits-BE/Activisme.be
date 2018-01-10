<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalendarTest extends TestCase
{
    /**
     * @test
     * @testdox Test of men de kalender pagina zonder fouten kan bekijken.
     */
    public function index(): void
    {
        $this->get(route('calendar.index'))
            ->assertStatus(200);
    }
}
