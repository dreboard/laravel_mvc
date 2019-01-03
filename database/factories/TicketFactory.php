<?php

use Faker\Generator as Faker;

$factory->define(\App\Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->text,
        'create_date' => (new DateTime)->format('Y-m-d'),
        'due_date' => (new DateTime)->modify('+1 month')->format('Y-m-d'), // secret
        'completed' => 0,
        'project_id' => random_int(1,5),
        'user_id' => 2,
        'created_by' => 2,
        'status' => 'new',
        'priority' => 'low',
        'open_edit' => 1
    ];
});
