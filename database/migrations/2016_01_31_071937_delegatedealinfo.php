<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Delegatedealinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('delegatedealinfo', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('deal_id');
            $table->string('leadcode');
             $table->string('boq');
            $table->string('vip');

            $table->string('hotel');
            $table->string('logo');
          
           
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
       chema::drop('delegatedealinfo');
    }
}
