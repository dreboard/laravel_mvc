<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->dateTime('note_date')->default(date('Y-m-d H:i:s'));
            $table->text('note');
            $table->integer('ticket_id')->unsigned()->default(0);
            $table->integer('project_id')->unsigned()->default(0);
            $table->integer('site_id')->unsigned()->default(0);
            $table->integer('created_by')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
