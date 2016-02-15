<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Leadsheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadsheet', function (Blueprint $table) {
            $table->increments('id');
          
            $table->string('company_name');
            $table->string('product_category');
            $table->integer('phone');
            $table->integer('other_office');
            $table->string('partnership_package_name');
            $table->string('partnership_package_value');

            $table->string('dmname');
            $table->string('dmdesignation');
            $table->integer('dmphone');
            $table->string('dmmobile');
            $table->string('dmemail');
            $table->integer('dmaltnumber');

            $table->string('infname');
            $table->string('infdesignation');
            $table->integer('infphone');
            $table->string('infmobile');
            $table->string('infemail');
            $table->integer('infaltnumber');

            $table->string('specname');
            $table->string('specdesignation');
            $table->integer('specphone');
            $table->string('spemobile');
            $table->string('speemail');
            $table->integer('spealtnumber');

            $table->string('remarks');
            $table->string('competitors');
            $table->string('empid');
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
