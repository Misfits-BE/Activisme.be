<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBe\Article::class, function (Faker $faker): array {
    return [
        'author_id' => function (): int {
            return factory(ActivismeBe\User::class)->create()->id;
        },
        'is_published' => 'Y',
        'slug' => 'news-article-message',
        'title' => $faker->realText(30),
        'message' => $faker->realText(100),
        'publish_date' => $faker->date(),
    ];
});
