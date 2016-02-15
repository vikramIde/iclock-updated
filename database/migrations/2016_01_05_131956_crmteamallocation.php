<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Crmteamallocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crmteamallocation', function (Blueprint $table) {
            $table->increments('id');
            
            
            $table->string('empid');
             $table->string('empname');
             $table->string('teamid');
             $table->string('teamname');
              $table->string('position');
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
       Schema::drop('crmteamallocation');
    }
}
