<?php

namespace App\Abstracts;

 
 class EventTransformer extends Transformer
{
 

public function transform($event)
	{
		
				
				return [
						'event'=> $event['event'],
						'date' => $event['date'],
						'e_code'=> $event['eventcode'],
						'country'=> $event['country'],
						'city'=> $event['city']
				];
		
	}

}
