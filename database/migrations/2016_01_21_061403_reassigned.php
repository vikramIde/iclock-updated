<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reassigned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reassigned', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('leadid');
            $table->string('leadcode');
            $table->string('assigntoid');
            $table->string('assigntoname');
            $table->string('assignedbyid');
            $table->string('assignedbyname');
           
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
        Schema::drop('reassigned');
    }
}
