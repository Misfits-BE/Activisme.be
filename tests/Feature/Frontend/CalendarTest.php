<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CalendarTest
 *
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class CalendarTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the calendar index page is accessible
     */
    public function IndexPage(): void
    {
        $this->get(route('calendar.index'))->assertStatus(200);
    }
}
