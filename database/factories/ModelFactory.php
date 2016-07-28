<?php

$factory->define(\App\User::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(\App\Models\Author::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->name,
        'biography' => join(" ", $faker->sentences(rand(3, 5))),
        'gender'    => rand(1, 6) % 2 === 0 ? 'male' : 'female',
    ];
});

$factory->define(\App\Models\Book::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(rand(3, 10));

    return [
        'title'       => substr($title, 0, strlen($title) - 1),
        'description' => $faker->text,
    ];
});

$factory->define(\App\Models\Bundle::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(rand(3, 10));

    return [
        'title'       => substr($title, 0, strlen($title) - 1),
        'description' => $faker->text(),
    ];
});
