<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations and seeder.
     *
     * @return void
     * @throws Exception
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 100);
            $table->text('description');
            $table->date('create_date')->default(date("Y-m-d"));
            $table->date('due_date')->default((new DateTime)->modify('+1 month')->format('Y-m-d'));
            $table->integer('user_id')->default(2);
            $table->integer('site_id')->unsigned();
            $table->integer('active')->default(0);
            $table->integer('created_by');
            $table->timestamps();
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });

        DB::table('projects')->insert(
            [
                'title' => "New Project",
                'description' => "This is a project",
                'create_date' => (new DateTime)->format('Y-m-d'),
                'due_date' => (new DateTime)->modify('+1 month')->format('Y-m-d'),
                'user_id' => 2,
                'site_id' => 1,
                'created_by' => 2,
                'active' => 1
            ]
        );

        $seeder = new ProjectTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
