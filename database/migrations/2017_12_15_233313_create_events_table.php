<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->string('name'); 
            $table->string('status');
            $table->string('start_time'); 
            $table->string('end_time');
            $table->timestamps();

            // Foreign keys 
            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::create('calendar_events', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('calendar_id')->unsigned();
            $table->integer('events_id')->unsigned();
            $table->timestamps();

            // Foreign keys 
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints(); 
        Schema::dropIfExists('events');
        Schema::dropIfExists('calendar_events');
        Schema::enableForeignKeyConstraints(); 
    }
}
