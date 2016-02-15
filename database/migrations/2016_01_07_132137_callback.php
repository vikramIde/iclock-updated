<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Callback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callback', function (Blueprint $table) {
            $table->increments('id');
          
            $table->dateTime('timeofcall');
            $table->string('results');
            $table->dateTime('nextcalldate');
            $table->string('schedule');
            $table->string('empid');
            $table->integer('leadid');
           
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
        Schema::drop('leadsheet');
    }
}
