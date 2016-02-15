<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leadsheet extends Model
{
       protected $table = 'leadsheet';
    
       /**
     * Get the callbacks for the blog post.
     */
    public function callback()
    {
        return $this->hasMany('App\callback');
        	 return $this->hasMany('App\reassigned');		
    }

}
