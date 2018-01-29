<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('processed')->default('N');
            $table->integer('backer_id')->unsigned(); 
            $table->string('transaction_id')->commend('Transaction id in the payment provide Mollie.');
            $table->string('amount');
            $table->string('status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('backer_id')->references('id')->on('gifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gifts');
    }
}
