<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBe\Article::class, function (Faker $faker): array {
    return [
        'author_id' => function ($faker): int {
            return factory(ActivismeBe\User::class)->create()->id;
        },
        'is_published' => $faker->boolean,
        'slug' => $faker->slug,
        'title' => $faker->title,
        'message' => $faker->text,
        'publish_date' => $faker->date('Y-m-d')
    ];
});
