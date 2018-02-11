<?php

use Faker\Generator as Faker;
use ActivismeBe\User;

$factory->define(ActivismeBe\Tag::class, function (Faker $faker) {
    return [
        'author_id' => function (): int {
            return factory(User::class)->create()->id;
        },
        'slug' => $faker->word, 
        'name' => $faker->word,
        'description' => $faker->paragraph
    ];
});
