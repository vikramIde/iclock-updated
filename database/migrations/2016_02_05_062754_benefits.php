<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Benefits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('deal_id');
              $table->string('leadcode');
            $table->string('hotelaccommodation');
             $table->string('specification');
            $table->string('flightticket');
             $table->string('airportpickupdrop');
            $table->string('visa');
        
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
         Schema::drop('benefits');
    }
}
