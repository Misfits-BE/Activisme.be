<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 * ---
 * Boot class voor de phpunit testsuites
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
