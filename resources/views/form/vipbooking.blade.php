<!DOCTYPE html>
<html>

<head>
<title>IDE Consulting Services Pvt Ltd</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="{{asset('/booking/style.css')}}" media="all" />
<link rel="stylesheet" type="text/css" href="{{asset('/booking/demo.css')}}" media="all" />
 <link rel="stylesheet" href="{{asset('/css/quirk.css')}}">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

  
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />

    
 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript">
function testForEnter() 
{    
	if (event.keyCode == 13) 
	{        
		event.cancelBubble = true;
		event.returnValue = false;
         }
} 
</script>

 <style type="text/css">
table {
     background-color: #ffffff !important; 
}
 </style>
</head>

<body>
<div class="container">

<header>
<h1><img src="{{asset('/booking/header.png')}}" width="900"></h1>
</header>

<div class="form">
<center>
<h1 style=" font-size: 25px;color:rgb(0, 0, 0);font-weight: bold;"><u>DELEGATE CONFIRMATION FORM</u></h1></center>
     @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
<form id="contactform"  name="myform" action="{{ url('/form/insertvipbookingform') }}" method="post">
  @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="token" value="{{$leadedit->confirmation_code}}">
                                      <input type="hidden" name="leadid" value="{{$leadedit->id}}">
                                      <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">
                                         <input type="hidden" name="empid" value="{{$leadedit->empid}}">
                                 
          @endforeach
          @foreach($dealtype as $deal)
            <input type="hidden" name="kindofsub" value="{{$deal->kindofsub}}">
          @endforeach
@foreach($event as $ev)
             <h1 style=" font-size: 18px;color: rgb(0, 0, 0);"> <u>EVENT DETAILS</u></h1>
          <table width="100%" >

<tr><td><label>Event  Name : {{$ev->event}}</label></td>
</tr>
<tr><td><label>Place of Event  : {{$ev->city}}- {{$ev->country}}</label></td>
</tr>
<tr><td><label>Tentative Date Of Event : {{$ev->date}}</label></td>
</tr>

</table>
@endforeach
<p>&nbsp;</p>
@foreach($dealtype as $dealt)
@foreach($leadsheet as $leadsh)
    
          <table width="100%" >
<table width="50%" align="left">
<tr><td><label>Company Name : {{$dealt->Companyname}}</label></td>
</tr>
<tr><td><label>Telephone No  : {{$leadsh->phone}}</label></td>
</tr>
<tr><td><label>Fax : {{$leadsh->fax}}</label></td>
</tr>
</table>
<table width="50%" align="right">
<tr>
<td><label>Address : {{$dealt->billingadd}}</label></td></tr>
<tr><td><label>City : {{$dealt->billingadd}}</label></td>
</tr>
<tr><td><label>Country : {{$leadsh->country}}</label></td>
</tr>
</table>
@endforeach
@endforeach
</table>
<p>&nbsp;</p>
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"><u>RESERVATION</u></h1>
<table width="100%">
	         <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<table width="50%" align="left">
	
     
		<tr>
			<td ><label>Primary Delegate <span style="color:red">*</span></label></td>
			<td ><input type="text" name="pname" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td><label>Name</label></br>
			<span> [as it should appear

on Badge]</span></td>
<td><input type="text" autocomplete="off" name="pnameonbadge"></td>
		</tr>
		<tr>
			<td ><label>Job Title</label></td>
			<td ><input type="text" name="pdesg" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		<tr>
			<td ><label>Passport Number <span style="color:green">#</span> </label></td>
			<td ><input type="text" name="ppassport" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Email  </label></td>
			<td ><input type="text" name="pemail" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Mobile</label></td>
			<td><input type="text" name="pmobile" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Direct Line</label></td>
			<td ><input type="text" name="pdirectline" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		
	</table>
	<table width="50%" align="right">
		<tr>
			<td ><label>Secondary Delegate <span style="color:red">*</span></label></td>
			<td ><input type="text" name="sname" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td><label>Name</label></br>
			<span> [as it should appear

on Badge]</span></td>
<td><input type="text" autocomplete="off" name="snameonbadge"></td>
		</tr>
		<tr>
			<td ><label>Job Title </label></td>
			<td><input type="text" name="sdesg" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		<tr>
			<td ><label>Passport Number <span style="color:green">#</span></label></td>
			<td ><input type="text" name="spassport" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		<tr>
			<td ><label>Email  </label></td>
			<td ><input type="text" name="semail" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td><label>Mobile</label></td>
			<td ><input type="text" name="smobile" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Direct Line</label></td>
			<td ><input type="text" name="sdirectline" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		
	</table>
	
	
</table>
<p>&nbsp;</p>
<table width="100%" style="line-height: 20px;">
	<tr>
		<td><span style="color:red">*</span>   Primary Delegate will be the key person with whom all the communications with regards to our initiative and its related information would be share, including any reservations in terms of this booking form.</td>
	</tr>
	<tr>
		<td><span style="color:green">#</span>  Passport Number are mandatory for delegates who travel from outside the country of origin, in which our initiative is hosted. However we would seek all the delegates to present us this number to differentiate one delegate from another.</td>
	</tr>
</table>
<table width="100%"  style="line-height: 20px;">
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"> <u>PACKAGE BENEFITS</u></h1>
<tr>
<td>&#187;  &nbsp; Program Agenda and directory will be communicated along with the list of all the speakers, sponsors and partners.</td></tr>

<tr><td>&#187;  &nbsp;  Notification of all the attending solution provider / supplier companies, 10 days prior to the initiative.</td></tr>

<tr><td>&#187; &nbsp; The above named representatives of your company will have complete access to attend the pre scheduled face-to-face business meetings with the &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;participating solution providers, education sessions, conferences and networking sessions, if any;</td></tr>

<tr><td>&#187; &nbsp;  Access to 5-star breakfast, luncheon, cocktail dinner and networking coffee breaks.</td></tr>

<tr><td>&#187;  &nbsp;   Coverage of your “company logo” on Marketing Collaterals of said initiative and prominent positioning of your company logo on the backdrop along with &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;all our other partners at event venue.</td></tr>


</table>
<p>&nbsp;</p>
<table width="100%"  style="line-height: 20px;">
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"><u>ADDITIONAL BENEFITS</u></h1>

<?php
foreach($benefits as $ben){

}
?>
<?php
if($ben->hotelaccommodation=='1'){
	?>


	<tr>
<td>1. Complimentary Accommodation (1 Single / Double Occupancy room per company) for one Night at the Five Star venue.</td></tr>

<?php
}
if($ben->flightticket=='1'){
	?>


		<tr>
<td>2.	Economic Class Flight Ticket “to and from” the nearest place of initiative.</td></tr>

	<?php

}


if($ben->airportpickupdrop=='1'){
	?>


	<?php

}
if($ben->visa=='1'){
?>
<tr><td>3.Documentation [Paper work] related to obtaining the VISA for participating in our initiative.</td></tr>


<tr>
	<td><b>Note:</b> After successful completion of your registration for this initiative, in terms of this agreement, our operations team will be in contact with the primary delegate for completing the pre-requisites of above additional benefits.</td>
</tr>
<?php
}
?>
<tr><td>Note: After successful completion of your registration for this initiative, in terms of this agreement, our operations team will be in contact with the primary delegate for completing the pre-requisites of above additional benefits. </td></tr>
</table>
<?php
if($deal->kindofsub=='paid'){
?>
<p>&nbsp;</p>
<table width="100%"  style="line-height: 20px;">

<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"> <u>PRICING AND PAYMENT POLICY</u></h1>
PRIC AND PAYMENT POLICY: We will process the payment Of the subscribed package on the following conditions:
<p>&nbsp;</p>
<tr>
<td>1. The Subscribing charge for the package selected by you will be  <?php echo $deal->Dealcurr;   echo '  : ' ; echo $deal->Dealvalue;  ?></td></tr>

<tr><td>2. The subscription amount should be paid on or before [7th date from the date of invoicing]</td></tr>

<tr><td>3. The Overseas Bank charges [if any] shall be borne by participating company. IDE Consulting Services Private Limited, Shall receive FULL VALUE of subscription.</td></tr>
<tr><td>4. The subscription amount shall be transferred only to the bank account which is mentioned in the Pro-forma invoice.</td></tr>

<tr><td>5<b>CANCELLATION:</b> A signed booking form commits clients to 100% Of the above fees on Confirmation</td></tr>

</table>
<?php
}

?>
<p>&nbsp;</p>

<table width="100%"  style="line-height: 20px;">
	<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"> <u>TERMS AND CONDITIONS </u></h1>

In terms of this agreement the participating company named above “SERVICE RECEIVER” (which expression shall mean and include primary delegate and/or secondary delegate (if any) and/or such other successors); do hereby agree the following;
<p>&nbsp;</p>
<tr>
<td>&#187;  &nbsp;  I/We confirm our attendance for both the days of the initiative.</td></tr>
<tr>
	<td>&#187;  &nbsp;   I/We will assign an alternate point of contact in case if we are unreachable, for any coordination post registration</td>
</tr>
<tr><td>&#187;  &nbsp;    I/We agree that, If due to any unforeseen circumstances, I/We are unable to attend the initiative, I/We will nominate another delegate(s) from our company &nbsp;&nbsp;&nbsp;&nbsp;(provided that the delegate(s) is / are of equal standing in the company) 10 days prior and ensure that the delegate(s) attends the initiative.</td></tr>
<tr>
<td>&#187;  &nbsp;   I/We agree that I/We will observe local and regional customs and refrain from any behaviour which is libellous, slanderous or otherwise defamatory.</td></tr>
<tr>
<td>&#187;  &nbsp;   I/We IDE Consulting services Private Limited., and any related parties, other delegate, sponsors and media participants may photograph, and record via&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;video or audio methods your participation in the initiative and waive any and all claims against IDE Consulting Services Private Limited., as a result of this. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/we further agree that IDE Consulting Services Private Limited., may use any recordings or photographs it takes (i) on its websites, (ii) to share with other &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;attendees (iii) or for future marketing purposes.</td></tr>
<tr>
<td>&#187;  &nbsp; I/We agree that, IDE Consulting Service Private Limited., will not be directly or indirectly responsible for any out-of-pocket costs incurred by me/us,&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;including inter alia (i) travel to and from the place of initiative or otherwise in connection with the initiative, hotel or other lodging costs (if any), and any &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;refreshments not included in the above benefits list and these are not included in the registration fee (if any)</td></tr>
<tr>
<td>&#187;  &nbsp; I/We agree that, if for any reason the initiative is cancelled or postponed for any reason, the IDE Consulting Service Private Limited., are not liable for any &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out-of-pocket costs incurred by the service receiver.</td></tr>
<tr>
<td>&#187;  &nbsp;  I/we agree that, IDE Consulting Service Private Limited., reserves the right to prohibit or allow anyone from attending the initiative at its final discretion.</td></tr>

</table>
<table width="100%"  style="line-height: 20px;">
	<h1 style=" font-size: 18px;color: rgb(0, 0, 0);"> <u>COMPULSORY</u></h1>
By submitting this form online, you agree that you have read and understood the terms and conditions of this agreement.
<tr></tr>
<tr>
<td> Accept the Terms & Conditions   <input type="checkbox" name="check"></td></tr>

<tr>
<td>Agreed by Name: <input type="text" style="width:50%"  name="agreedname"></td>
<td>Date of Agreement : <p id="basicExample"><input type="text"  style="width:50%" name="checkindate"  onkeydown="testForEnter();" class="date start" id="dob" autocomplete="off" ></p></td>
</tr>

</table>
<p>&nbsp;</p>
<table width="100%" style="line-height: 20px;">
	<tr>
		<td><b>Declaration :</b> This  is an Electronic Form. Since this link  is sent to a specified email address,  does not require signature & stamping of service receiver. </td></tr>
</table>
<p>&nbsp;</p>
<table width="100%"  align="center">
<tr>
<td></td><td></td><td></td><td></td><td></td><td></td> 
<td >
<input class="buttom" name="submit" id="submit" tabindex="5" value="Submit" type="submit">
</td>
</tr>
</table>


</br>
</br>

</form>

</div>

<header>
<h1><img src="{{asset('/booking/footer.png')}}" width="900"></h1>
</header>
</div>
<script>
                $('#basicExample .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:ia'
                });

                $('#basicExample .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });

                var basicExampleEl = document.getElementById('basicExample');
                var datepair = new Datepair(basicExampleEl);
            </script>
</body>


</html>