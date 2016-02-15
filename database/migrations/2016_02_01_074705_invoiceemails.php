<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoiceemails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
         Schema::create('invoiceemails', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('deal_id');
              $table->string('leadcode');
            $table->string('name');
             $table->string('mobile');
            $table->string('email');
             $table->string('desg');
            $table->string('dept');
            $table->string('invoicemark');
          
          
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
      Schema::drop('invoiceemails');
    }
}
