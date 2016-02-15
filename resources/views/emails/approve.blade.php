<?php 

use App\vipbooking;
use App\Deal;
use App\Event;
foreach($vipdata as $data){
$email=$data->email;
$empid=$data->empid;
$leadcode=$data->leadcode;
$dealid=$data->deal_id;
$rcom=$data->rcomments;
}
foreach($dealdata as $lead){
}
foreach($tenevent as $eve){
}
foreach($leadsheet as $inv){
}
foreach($benefits as $inv){
}
?>
	<p><b>Dear {{$inv->clientname}}	</b></p>								
										
	<p>We thank  <b>{{$lead->Companyname}} </b>for giving us an opportunity to serve you at our initiative <b>{{$lead->Eventname}}</b>  to be held on <b>{{$eve->date}}</b> at <b>{{$eve->city}},{{$eve->country}}</b>								
		</p>								
										
	<p>Please find the pdf attached</p>								
										
	<p>Thanks and Regards</p>
	<p>On Behalf of Team IDE</p>									
									


