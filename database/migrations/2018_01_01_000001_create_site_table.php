<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('url', 100);
            $table->string('ga', 20);
            $table->integer('submitted');
            $table->string('git_url');
            $table->integer('created_by');
            $table->decimal('rate')->default(40.00);
            $table->timestamps();
        });

        DB::table('sites')->insert(
            [
                'title' => "New Site",
                'description' => "This is a site",
                'url' => 'www.test.com',
                'ga' => 'UA-12345678',
                'submitted' => 1,
                'git_url' => 'github.com/tester',
                'created_by' => 2,
                'rate' => 50.00
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site');
    }
}
