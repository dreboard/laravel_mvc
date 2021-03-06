<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->text,
        'create_date' => (new DateTime)->format('Y-m-d'),
        'due_date' => (new DateTime)->modify('+1 month')->format('Y-m-d'), // secret
        'user_id' => 2,
        'site_id' => 1,
        'created_by' => 2,
        'active' => 1
    ];
});
