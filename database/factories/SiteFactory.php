<?php

use Faker\Generator as Faker;

$factory->define(App\Site::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->text,
        'url' => $faker->url,
        'ga' => 'UA-72571847-1', // secret
        'submitted' => 1,
        'git_url' => 'https://github.com/dreboard/laravel_mvc',
        'created_by' => 3,
    ];
});
