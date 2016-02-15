<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vipbooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('vipbooking', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('leadid');
            $table->string('leadcode');
             $table->string('empid');
            $table->string('pname');
            $table->string('pemail');
            $table->string('pmobile');
            $table->string('pdesg');
            $table->string('sname');
            $table->string('semail');
            $table->string('smobile');
            $table->string('sdesg');
            $table->string('token');
            $table->dateTime('datetime');
           
           
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
        Schema::drop('vipbooking');
    }
}
