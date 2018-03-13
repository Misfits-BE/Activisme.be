<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBe\Calendar::class, function (Faker $faker) {
    return ['start_date' => $faker->date()];
});
