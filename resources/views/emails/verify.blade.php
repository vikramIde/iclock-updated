<?php 
use App\User;

$lastId = User::get()->last();
$lastinvoice = User::where('id',$lastId->id)->get();

?>
@foreach($lastinvoice as $inv)

 <p>Password : {{$inv->password}} </p>

@endforeach
