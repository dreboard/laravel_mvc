<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('description');
            $table->date('create_date');
            $table->date('due_date');
            $table->integer('completed');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->integer('created_by');
            $table->enum('status',['new','working','complete','closed']); // Place the default value as the first element in the array
            $table->enum('priority', ['low','medium','high','urgent']);
            $table->integer('open_edit')->default(1);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
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
