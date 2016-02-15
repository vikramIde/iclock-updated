<?php 

use App\vipbooking;
use App\Deal;
use App\Event;

$lastId = vipbooking::get()->last();

$lastinvoice = vipbooking::where('id',$lastId->id)->get();



foreach($lastinvoice as $inv){

$leadcode=$inv->leadcode;

$token=$inv['confirmation_code'];
$token1=str_random(30);
 	


}
$details=Deal::where('leadcode',$leadcode)->get();
foreach ($details as $lead) {

	$eventc=$lead->Eventcode;
}
$event=Event::where('eventcode',$eventc)->get();
foreach($event as $eve){

}

?>
	<p><b>Dear {{$inv->clientname}}	</b></p>								
										
	<p>We thank<b>{{$lead->Companyname}} </b>for giving us an opportunity to serve you at our initiative <b>{{$lead->Eventname}}</b>to be held on <b>{{$eve->date}}</b>at <b>{{$eve->city}},{{$eve->country}}</b>								
	As part of the confirmation process you need to fill up a registration form.	</p>								
										
	<p>Please find the attachment of delegate confirmation form</p>	


							
										
	<p>Thanks and Regards</p>
	<p>On Behalf of Team IDE</p>									
									


