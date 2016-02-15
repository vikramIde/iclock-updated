<?php

namespace App\Abstracts;

use eventsTransformer;


abstract class Transformer
{
 

public function transformCollection(array $item)
{
   	return array_map([$this ,'transform'],$item->toArray());
} 

public abstract function transform($event);

}
