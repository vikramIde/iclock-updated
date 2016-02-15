<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12px" >
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table cellspacing="0" style="width: 700px; text-align: center; margin-left:15px;font-size: 14px ;margin-top:10px">
        <tr>
            <td style="width: 140px;">
                 <img style="width: 100%;" src="{{asset('/img/ide_color_logo.jpg')}}" alt="Logo">
            </td>
           
        </tr>
    </table>
    
     <table cellspacing="0" align="center" style="width: 700px; text-align: center; font-size: 20px; " >
        <tr>
            <td style="text-align:center">
                <u>DELEGATE CONFIRMATION FORM</u>
            </td>
           
        </tr>
    </table>

 @foreach($tenevent as $ev)

 <table cellspacing="0"  style=" text-align: left; font-size: 12px; margin-left:20px;padding:10px;margin-top:5px;"  >
<tr><td> <h1 style=" font-size: 12px;color: rgb(0, 0, 0);margin-left:20px;"> <u>EVENT DETAILS</u></h1></td></tr>
<tr><td>Event  Name </td><td>: &nbsp;{{$ev->event}}</td></tr>
<tr><td>Place of Event  </td><td>: &nbsp;{{$ev->city}}- {{$ev->country}}</td></tr>
<tr><td>Tentative Date Of Event  </td><td>: &nbsp;{{$ev->date}}</td></tr>

</table>
@endforeach
@foreach($dealdata as $dealt)
@foreach($leadsheet as $leadsh)
    
 <table cellspacing="0"  width="100%" style="height:40px; margin-left:15px;float:left; font-size: 12px; margin-left:20px;padding:10px;">
    <tr>
        <td>
<table cellspacing="0"  width="50%" style=" border: solid 0.5px #ccc; float:left;font-size: 12px0;padding:10px;">
<tr><td width="50%">Company Name</td><td style="width:200px">: &nbsp;{{$dealt->Companyname}}</td>
</tr>
<tr><td width="50%">Telephone No  </td><td style="width:150px">: &nbsp;{{$leadsh->phone}}</td>
</tr>
<tr><td width="50%">Fax </td><td style="width:150px">: &nbsp;{{$leadsh->fax}}</td>
</tr>
</table>
</td>
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>
<table cellspacing="0"  width="50%" style=" border: solid 0.5px #ccc; float:right;font-size: 12px;padding:10px;">
<tr><td width="30%">Address </td><td style="width:350px">: &nbsp;{{$dealt->billingadd}}</td>
</tr>
<tr><td width="50%">City   </td><td style="width:350px">: &nbsp;{{$leadsh->phone}}</td>
</tr>
<tr><td width="50%">Country  </td><td style="width:350px">: &nbsp;{{$leadsh->country}}</td>
</tr>
</table>
</td>
</tr>

</table>
@endforeach
@endforeach
@foreach($vipdata as $vip)

    
 <table cellspacing="0"  width="100%" style="height:40px; margin-left:15px;float:left; font-size: 12px; margin-left:20px;padding:10px;">
    <tr>
        <td><h1 style=" font-size: 12px;color: rgb(0, 0, 0); margin-left:20px"><u>DELEGATE  DETAILS</u></h1></td></tr>
    <tr>
        <td>
<table cellspacing="0"  width="50%" style=" border: solid 0.5px #ccc; float:left;font-size: 12px; padding:10px;">
<tr>
            <td ><label>Primary Delegate </label></td>
            <td >: {{$vip->pname}}</td>
        </tr>
        <tr>
            <td><label>Name</label>  
            <span> [as it should appear

on Badge]</span></td>
<td>: {{$vip->pnameonbadge}}</td>
        </tr>
        <tr>
            <td ><label>Job Title</label></td>
            <td >: {{$vip->pdesg}}</td>
        </tr>
        <tr>
            <td ><label>Passport Number  </label></td>
            <td >: {{$vip->ppassport}}</td>
        </tr>
        <tr>
            <td ><label>Email  </label></td>
            <td >: {{$vip->pemail}}</td>
        </tr>
        <tr>
            <td ><label>Mobile</label></td>
            <td>: {{$vip->pmobile}}</td>
        </tr>
        <tr>
            <td ><label>Direct Line</label></td>
            <td >: {{$vip->pname}}</td>
        </tr>
</table>
</td>

        <td>
<table cellspacing="0"  width="50%" style=" border: solid 0.5px #ccc; float:right;font-size: 12px; padding:10px;">
<tr>
            <td ><label>Secondary Delegate</label></td>
            <td >: {{$vip->sname}}</td>
        </tr>
        <tr>
            <td><label>Name</label>  
            <span> [as it should appear

on Badge]</span></td>
<td>: {{$vip->snameonbadge}}</td>
        </tr>
        <tr>
            <td ><label>Job Title </label></td>
            <td>: {{$vip->sdesg}}</td>
        </tr>
        <tr>
            <td ><label>Passport Number </label></td>
            <td >: {{$vip->spassport}}</td>
        </tr>
        <tr>
            <td ><label>Email  </label></td>
            <td >: {{$vip->semail}}</td>
        </tr>
        <tr>
            <td><label>Mobile</label></td>
            <td >: {{$vip->smobile}}</td>
        </tr>
        <tr>
            <td ><label>Direct Line</label></td>
            <td >: {{$vip->pname}}</td>
        </tr>
</table>
</td>
</tr>

</table>

@endforeach
 <table cellspacing="0" align="left" style="width: 700px; text-align: justify; font-size: 12px;margin-left:20px;padding:5px;"  >
<tr><td><h1 style=" font-size: 12px;color: rgb(0, 0, 0);"> <u>PACKAGE BENEFITS</u></h1></td></tr>
<tr>
<td>&#187;  &nbsp; Program Agenda and directory will be communicated along with the list of all the speakers, sponsors and partners.</td></tr>

<tr><td>&#187;  &nbsp;  Notification of all the attending solution provider / supplier companies, 10 days prior to the initiative.</td></tr>

<tr><td>&#187; &nbsp; The above named representatives of your company will have complete access to attend the pre scheduled face-to-face business<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meetings with  the participating solution providers, education sessions, conferences and networking sessions, if any;</td></tr>

<tr><td>&#187; &nbsp;  Access to 5-star breakfast, luncheon, cocktail dinner and networking coffee breaks.</td></tr>

<tr><td>&#187; &nbsp; Coverage of your “company logo” on Marketing Collaterals of said initiative and prominent positioning of your company logo <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;on the backdrop along with  all our other partners at event venue.</td></tr>

</table>
 <table cellspacing="0" align="left" style="width: 600px; text-align: justify; font-size: 12px; margin-left:20px;padding:5px;"  >
    <tr><td><h1 style=" font-size: 12px;color: rgb(0, 0, 0);"> <u>ADDITIONAL BENEFITS</u></h1></td></tr>
    @foreach($benefits as $ben)
    @if($ben->hotelaccommodation=='1')
    <tr>
<td>&#187; &nbsp; Complimentary Accommodation (1 Single / Double Occupancy room per company) for one Night at the Five Star venue.</td></tr>
    @endif
     @if($ben->flightticket=='1')
         <tr>
<td>&#187; &nbsp;  Economic Class Flight Ticket “to and from” the place of initiative.</td></tr>
    @endif
     @if($ben->airportpickupdrop=='1')
    @endif
     @if($ben->visa=='1')
     <tr><td>&#187; &nbsp;  Documentation [Paper work] related to obtaining the VISA for participating in our initiative.</td></tr>
    @endif
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td><b>Note: </b>After successful completion of your registration for this initiative, in terms of this agreement, our operations team will be in <br>contact with the primary delegate for completing the pre-requisites of above additional benefits.</td></tr>
@endforeach
</table>
@if($dealt->kindofsub=='paid')
 <table cellspacing="0" align="left" style="width: 600px; text-align: left; font-size: 12px; margin-left:20px;margin-left:20px;padding:10px;"  >
    <tr><td><h1 style=" font-size: 12px;color: rgb(0, 0, 0);"> <u>PRICING AND PAYMENT POLICY</u></h1></td></tr>
<tr>
<td>1. The Subscribing charge for the package selected by you will be  <b><?php echo $dealt->Dealcurr;   echo '  : ' ; echo $dealt->Dealvalue;  ?></b></td></tr>

<tr><td>2. The subscription amount should be paid on or before [7th date from the date of invoicing]</td></tr>

<tr><td>3. The Overseas Bank charges [if any] shall be borne by participating company. IDE Consulting Services Private Limited, Shall receive<br> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FULL VALUE </b>of subscription.</td></tr>
<tr><td>4. The subscription amount shall be transferred only to the bank account which is mentioned in the Pro-forma invoice.</td></tr>

<tr><td>5. <b> CANCELLATION:</b> A signed booking form commits clients to 100% Of the above fees on Confirmation</td></tr>

</table>


@endif
</page>
<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12px" >
 <table cellspacing="0" align="left" style="width: 600px; text-align: left; font-size: 12px; margin-left:20px;padding:10px;"  >
    <tr><td><h1 style=" font-size: 12px;color: rgb(0, 0, 0);"> <u>TERMS AND CONDITIONS</u></h1></td></tr>
<tr>
<td>&#187;  &nbsp;  I/We confirm our attendance for both the days of the initiative.</td></tr>
<tr>
    <td>&#187;  &nbsp;   I/We will assign an alternate point of contact in case if we are unreachable, for any coordination post registration</td>
</tr>
<tr><td>&#187;  &nbsp;    I/We agree that, If due to any unforeseen circumstances, I/We are unable to attend the initiative, I/We will nominate another <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;delegate(s)  from our company (provided that the delegate(s) is / are of equal standing in the company) 10 days prior and ensure<br>&nbsp;&nbsp;&nbsp;&nbsp; that the delegate(s)  attendsthe  initiative.</td></tr>
<tr>
<td>&#187;  &nbsp;   I/We agree that I/We will observe local and regional customs and refrain from any behaviour which is libellous, slanderous or otherwise<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; defamatory.</td></tr>
<tr>
<td>&#187;  &nbsp;   I/We IDE Consulting services Private Limited., and any related parties, other delegate, sponsors and media participants may photograph,<br> &nbsp;&nbsp;&nbsp;&nbsp;and record via video or audio methods your participation in the initiative and waive any and all claims against IDE Consulting Services <br>&nbsp;&nbsp;&nbsp;&nbsp;Private Limited., as a result of this.I/we further agree that IDE Consulting Services Private Limited., may use any recordings or <br>&nbsp;&nbsp;&nbsp;&nbsp;photographs it takes (i) on its websites, (ii) to share with other attendees(iii) or for future marketing purposes.</td></tr>
<tr>
<td>&#187;  &nbsp; I/We agree that, IDE Consulting Service Private Limited., will not be directly or indirectly responsible for any out-of-pocket costs<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;incurred by me/us,including inter alia (i) travel to and from the place of initiative or otherwise in connection with the initiative, hotel <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or other lodging costs (if any), and any  refreshments not included in the above benefits list and these are not included in the <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;registration fee (if any)</td></tr>
<tr>
<td>&#187;  &nbsp; I/We agree that, if for any reason the initiative is cancelled or postponed for any reason, the IDE Consulting Service Private Limited., <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;are not liable for any out-of-pocket costs incurred by the service receiver.</td></tr>
<tr>
<td>&#187;  &nbsp;  I/we agree that, IDE Consulting Service Private Limited., reserves the right to prohibit or allow anyone from attending the initiative <br>&nbsp;&nbsp;&nbsp;&nbsp;at its final discretion.</td></tr>


</table>

 <table cellspacing="0" align="left" style="width: 600px; text-align: left; font-size: 12px; margin-left:20px;margin-left:20px;padding:10px;margin-top:5px;"  >
    <tr><td><h1 style=" font-size: 12px;color: rgb(0, 0, 0);"> <u>COMPULSORY</u></h1></td></tr>
<tr>
<td>By submitting this form online, you agree that you have read and understood the terms and conditions of this agreement.<br></td></tr>

<tr><td style=" padding-top: 10px;">  I  AGREE TO THE GIOHIS TERMS AND CONDITIONS &nbsp;&nbsp;<img src="{{asset('/img/checked_checkbox.png')}}" width="10"  height="10"> </td></tr>
<tr><td></td></tr>
<tr><td></td></tr>

<tr><td style=" padding-top: 30px;">Agreed by Name   : {{$vip->agreedname}}</td></tr>
<tr><td>Date of Agreement  : {{$vip->agreeddate}}</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td style="font-size:10px;padding-top: 50px;"><b><u>Declaration</u> :</b>This form is electronically submitted by the service receiver, where in his signature is not required, since this link will be sent to a specified email address only.</td></tr>

</table>

 <table cellspacing="0" align="left" style="width: 600px; text-align: left; font-size: 12px; margin-left:20px;margin-left:20px;padding:10px;margin-top:5px;"  >
 
<tr>
<td><b>Acknowledgement by<br><br> IDE Consulting Services Private Limited.</b></td></tr>

</table>

 <table cellspacing="0"  width="100%" style="height:40px; margin-left:15px;float:left; font-size: 12px; margin-left:20px;padding:10px;margin-top:5px;">
    <tr>
        <td>
<table cellspacing="0"  width="50%" style=" float:left;font-size: 12px0;padding:10px;margin-top:5px;">
<tr><td style="width:150px">  <img src="{{asset('/img/sign.jpg')}}" width="150"  ><br>&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; Signature  </td>
</tr>

</table>
</td>
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>
<table cellspacing="0"  width="50%" style=" float:left;font-size: 12px;padding:10px;margin-top:100px;margin-left:100%">
  <tr>
        <td > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Date  :  <?php

        $date=$vip->datetime;
        echo date('Y-m-d', strtotime($date));
        ?>
        </td>

    </tr>
</table>
</td>
</tr>

</table>
    </page>

   