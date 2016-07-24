<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Book::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(rand(3, 10));

    return [
        'title' => substr($title, 0, strlen($title) - 1),
        'description' => $faker->text,
        'author' => $faker->name
    ];
});