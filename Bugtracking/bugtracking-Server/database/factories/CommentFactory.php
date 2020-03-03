<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->paragraph
    ];
});
