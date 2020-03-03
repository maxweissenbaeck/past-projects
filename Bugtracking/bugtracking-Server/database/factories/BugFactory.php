<?php

use Faker\Generator as Faker;

$factory->define(\App\Bug::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph,
        'state' => $faker->randomElement($array = array ('Closed','Open')),
        'priority' => $faker->numberBetween(1, 3)
    ];
});
