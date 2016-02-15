<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class callback extends Model
{
    protected $table='callback';


    public function leadsheet(){

    		return $this->belongsTo('App\leadsheet');

    	}
}
