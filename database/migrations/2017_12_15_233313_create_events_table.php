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
            $table->integer('author_id');
            $table->string('name'); 
            $table->string('status');
            $table->string('start_time'); 
            $table->string('end_time');
            $table->timestamps();
        });

        Schema::create('calendar_events', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('calendar_id')->unsigned()->index();
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
            $table->integer('events_id')->unsigned()->index();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints(); 
        Schema::dropIfExists('events');
        Schema::dropIfExists('calendar_events');
        Schema::enableForeignKeyConstraints(); 
    }
}
