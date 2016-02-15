<?php 

use App\vipbooking;
use App\Deal;
use App\Event;

foreach($selectdata as $data){
$email=$data->email;
$empid=$data->empid;
$leadcode=$data->leadcode;
$dealid=$data->deal_id;
$rcom=$data->rcomments;
}



$lastId = vipbooking::get()->where('leadcode',$leadcode)->last();

$lastinvoice = vipbooking::where('id',$lastId->id)->where('id', DB::raw("(select max(`id`) from vipbooking)"))->get();



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

		<p><b>Dear {{$inv->clientname}} 	</b></p>								

		<p>	We regret  to inform that  your registration form for our initiative <b>{{$lead->Eventname}}</b>  is declined due to following reason;									
		{{$rcom}}									
		</p>							

		<p>	Request you to use the following  new  link  to submit the registration;									

		</p>
		<p>	Please follow the link to register for the initiative:		</p>								



		<p>VIP Booking Form Link : {{url('form/vipbooking/'.$token."===".$token1)}} </p>									

		<p>Thanks and Regards</p>
		<p>On Behalf of Team IDE</p>									



