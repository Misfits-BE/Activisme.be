<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsMailingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_mailings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->integer('sender_id')->nullable()->unsigned();
            $table->boolean('is_send');
            $table->string('slug');
            $table->string('status');
            $table->string('titel'); 
            $table->text('content');
            $table->timestamp('send_at')->nullable();
            $table->timestamps();

            // Foreign keys 
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('sender_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_mailings');
    }
}
