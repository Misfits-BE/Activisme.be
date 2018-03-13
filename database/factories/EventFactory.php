<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBe\Events::class, function (Faker $faker) {
    return [
        'author_id' => factory(ActivismeBe\User::class)->create()->id,
        'name' => $faker->title,
        'status' => 'public',
        'start_time' => $faker->time('H:i'),
        'end_time' => $faker->time('H:i')
    ];
});
