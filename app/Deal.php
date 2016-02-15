<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Deal extends Model

{

    //

     protected $table = 'deal';

     protected $primaryKey = 'Id';

     public function user()

  		{

    return $this->belongsTo('App\User');

  }

  

   public function events(){

	   return $this->belongsTo('App\Event');

   }

}

