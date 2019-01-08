<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations and seeder.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 255);
            $table->text('description');
            $table->date('create_date')->default(date("Y-m-d"));
            $table->date('due_date')->default((new DateTime)->modify('+1 month')->format('Y-m-d'));
            $table->integer('completed');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->default(2);
            $table->integer('created_by')->default(2);
            $table->enum('status',['new','working','complete','closed']); // Place the default value as the first element in the array
            $table->enum('priority', ['low','medium','high','urgent']);
            $table->integer('open_edit')->default(1);
            $table->timestamps();
            //$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        $seeder = new TicketTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
