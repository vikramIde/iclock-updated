<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hotelform extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelform', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('dealid');
              $table->string('leadcode');
            $table->string('checkindate');
             $table->string('checkoutdate');
            $table->string('checkintime');
             $table->string('checkoutitme');
            $table->string('noofnights');
            $table->string('guestpreference');
            $table->string('modeofpayment');
            $table->string('flightdetails');
            $table->string('timeofarrival');
            $table->string('timeofdeparture');
        
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
       Schema::drop('hotelform');
    }
}
