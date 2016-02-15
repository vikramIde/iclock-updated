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

 
</head>

<body>
<div class="container">

<header>
<h1><img src="{{asset('/booking/header.png')}}" width="900"></h1>
</header>
<center>
<h1 style=" font-size: 25px;color:rgb(0, 0, 0);font-weight: bold;">VIP BOOKING FORM</h1></center>
<div class="form">

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
<form id="contactform"  name="myform" action="{{ url('/initiator/insertvipbookingform') }}" method="post">
  @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="token" value="{{$leadedit->confirmation_code}}">
                                      <input type="hidden" name="leadid" value="{{$leadedit->id}}">
                                      <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">
                                 
          @endforeach
          @foreach($dealtype as $deal)
            <input type="hidden" name="kindofsub" value="{{$deal->kindofsub}}">
          @endforeach
          <table width="100%" >
<table width="50%" align="left">
<tr><td><label>Company Name : {{$deal->Companyname}}</label></td>
</tr>
</table>
<table width="50%" align="right">
<tr>
<td><label>Event Name : {{$deal->Eventname}}</label></td></tr>
</table>
</table>
<p>&nbsp;</p>
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);">1. <u>RESERVATION</u></h1>
<table width="100%">
	         <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<table width="50%" align="left">
	
     
		<tr>
			<td ><label>Primary Delegate</label></td>
			<td ><input type="text" name="pname" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Job Title</label></td>
			<td ><input type="text" name="pdesg" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		<tr>
			<td ><label>Passport Number </label></td>
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
		
	</table>
	<table width="50%" align="right">
		<tr>
			<td ><label>Secondary Delegate</label></td>
			<td ><input type="text" name="sname" autocomplete="off" onkeydown="testForEnter();"></td>
		</tr>
		<tr>
			<td ><label>Job Title </label></td>
			<td><input type="text" name="sdesg" autocomplete="off" onkeydown="testForEnter();" ></td>
		</tr>
		<tr>
			<td ><label>Passport Number</label></td>
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
		
	</table>
	
	
</table>
<p>&nbsp;</p>
<table width="100%" >
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);">2. <u>PACKAGE BENEFITS</u></h1>
<tr>
<td>•  Complimentary Accommodation (1 Single / Double Occupancy room per company) for 1 Night at the 5 star venue</td></tr>

<tr><td>•  Notification of all the attending companies 10 days prior to the initiative</td></tr>

<tr><td>•  Access to the Conference sessions and Networking activities</td></tr>

<tr><td>•  Coverage on Marketing Collaterals</td></tr>

<tr><td>•  Access to 5-star breakfast, luncheon, cocktail dinner and networking coffee breaks</td></tr>

<tr><td>•  Access to pre-scheduled Face- to- Face meetings with the participating solution providers</td>

</tr>
</table>
<p>&nbsp;</p>
<table width="100%" >
<h1 style=" font-size: 18px;color: rgb(0, 0, 0);">3. <u>CONFIRMATION POLICY</u></h1>
<tr>
<td>•  By filling up this form, I hereby confirm my attendance for the 2 days of the initiative</td></tr>

<tr><td>•  I will assign an alternate point of contact in case I am unreachable, for any coordination post registration</td></tr>

<tr><td>•  If due to any unforeseen circumstances, I am unable to attend the initiative, I will nominate another delegate(s) from the

 company (provided that the delegate(s) is / are of equal standing in the company) 10 days prior and ensure that the

 delegate(s) attends the initiative.</td></tr>


</table>
<?php
if($deal->kindofsub=='paid'){
?>
<p>&nbsp;</p>
<table width="100%" >

<h1 style=" font-size: 18px;color: rgb(0, 0, 0);">4. <u>TERMS AND CONDITIONS</u></h1>
PRIC AND PAYMENT POLICY: We will process the payment Of the subscribed package on the following conditions:
<tr>
<td>•  Total Amount to be paid:<?php echo $deal->Dealvalue; echo ' ' ;echo $deal->Dealcurr; ?></td></tr>

<tr><td>•  Date to be paid 100% by the 29th January 2016 as per invoice to be sent</td></tr>

<tr><td>•  All bank charges will be borne by your organisation. By bank transfer on the bank account of which the details will be mentioned cn the invoice that will be sent to me upon signature of the present contract</td></tr>

<tr><td>• <b>CANCELLATION:</b> A signed booking form commits clients to 100% Of the above fees on Confirmation</td></tr>

</table>
<?php
}

?>
<p>&nbsp;</p>
<table width="100%" >

<tr>
<td><input type="checkbox" name="check"> Accept the Terms & Conditions</td></tr>



</table>

<table width="100%" >
<tr>
<td></td><td></td><td></td>
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

</body>


</html>