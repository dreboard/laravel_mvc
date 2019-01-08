<?php

use App\Ticket;
use Illuminate\Database\Seeder;
use App\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Project::class, 3)->create();

        /*$projects = factory(Project::class, 3)
            ->create()
            ->each(function ($project) {
                $project->tickets()->save(factory(Ticket::class)->make());
            });*/
    }
}
