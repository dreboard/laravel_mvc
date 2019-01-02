<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->text,
        'create_date' => new DateTime(),
        'due_date' => (new DateTime)->modify('+1 month'), // secret
        'user_id' => 3,
        'site_id' => 1,
        'created_by' => 3,
        'active' => 1
    ];
});
