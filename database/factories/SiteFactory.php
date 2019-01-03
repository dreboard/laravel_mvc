<?php

use Faker\Generator as Faker;

$factory->define(App\Site::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->text,
        'url' => $faker->url,
        'ga' => 'UA-12345678-1',
        'submitted' => 1,
        'git_url' => 'https://github.com/tester/testsite',
        'created_by' => 2,
        'rate' => 40.00
    ];
});
