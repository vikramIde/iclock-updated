@extends('app')

@section('content')
<!-- <script type='text/javascript' src="{{asset('js/jquery-1.11.2.min.js')}}"></script> -->
<section>
  @foreach($emp as $en)

<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
@endforeach
  <div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->


      <div class="tab-content">

        <!-- ################# MAIN MENU ################### -->

        <div class="tab-pane active" id="mainmenu">
         

          <h5 class="sidebar-title">Main Menu</h5>
          
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <?php if(Auth::User()->role=='sales'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
                <li class="nav-parent">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                 <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs</span></a></li>
                <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>

              </ul>
            </li>
            <li class="nav-parent active ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>
             
             <ul class="children">
                <li><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
                  <li ><a  href="{{ URL::to('initiator/deals')}}"><i class="fa fa-pencil-square-o"></i><span> My Deals</span></a></li>
                      <?php
                              if($en->emp_department=='Delegates')
                              {
                                ?>
                   <li class="active"><a  href="{{ URL::to('initiator/pendingactivity')}}"><i class="fa fa-pencil-square-o"></i><span> My Pending Activity</span></a></li>
            <?php
          }
          ?>
              </ul>
            </li>
            <?php
            
                 if($en->emp_department=='Vendors')
                              {
                                ?>
               <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Variance Card</span></a>
             
             <ul class="children">
                <li><a href="{{ URL::to('initiator/variancecard')}}"><i class="fa fa-line-chart"></i><span> Variance Card</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Target Sheet</span></a>
             
             <ul class="children">
                <li><a href="{{ URL::to('initiator/target')}}"><i class="fa fa-line-chart"></i><span> My Target</span></a></li>
            
              </ul>
            </li>
        
            <?php } }?>
          </ul>
        </div><!-- tab-pane -->

    

      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <div class="contentpanel">
      

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a ><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a >Dashbord</a></li>
        <li class="active">Home</li>
      </ol>

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

      <div class="row">

             <div class="col-md-12">

         
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Update Deal</strong></a></li>
           
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
            
            <div class="row">
@foreach($lead_id as $lead)

        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading nopaddingbottom">
                <h4 class="panel-title">Deal Information ( {{$lead->leadcode}})<span style="color:red"> ( <?php echo count($editlead) ?> )</span></h4>
               
              </div>

              <div class="panel-body">

                <div class="row">

        <div class="col-md-6">
          <div class="panel">
              
              <div class="panel-body">
                <hr>
                <form  class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-6"><b>Company Name  :</b></label>
                    <div class="col-sm-6">
                   {{$lead->Companyname}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Event Name:</b></label>
                    <div class="col-sm-6">
                       {{$lead->Eventname}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Deal Date:</b></label>
                    <div class="col-sm-6">
                   {{$lead->Dealdate}}
                    </div>
                  </div>
                   
                 


                  <hr>


                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->

        </div><!-- col-md-6 -->
              <div class="col-md-6">
          <div class="panel">
              
              <div class="panel-body">
                <hr>
                <form  class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-6"><b>Deal type :</b></label>
                    <div class="col-sm-6">
                     {{$lead->kindofsub}}
                    </div>
                  </div>
                 <div class="form-group">
                    <label class="col-sm-6"><b>Deal Value:</b></label>
                    <div class="col-sm-6">
                   {{$lead->Dealvalue}}
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label class="col-sm-6"><b>Deal Curency  :</b></label>
                    <div class="col-sm-6">
                   {{$lead->Dealcurr}}
                    </div>
                  </div>
               
  
                  <hr>


                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->

        </div><!-- col-md-6 -->
      
      


      </div><!--row -->
    @endforeach 
            <div class="row">
            <?php
            if(count($editlead)>0){
            ?>
@foreach($editlead as $viplead)

        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading nopaddingbottom">
                <h4 class="panel-title">Delegate Details</h4>
               
              </div>

              <div class="panel-body">

                <div class="row">

        <div class="col-md-3">
          <div class="panel">
              
              <div class="panel-body">
                <hr>
                <form  class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-6"><b>Primary Name  :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->pname}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Designation:</b></label>
                    <div class="col-sm-6">
                     {{$viplead->pdesg}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Passport Number:</b></label>
                    <div class="col-sm-6">
                    {{$viplead->ppassport}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Email :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->pemail}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Mobile :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->pmobile}}
                    </div>
                  </div>
                 


                  <hr>


                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->

        </div><!-- col-md-6 -->
              <div class="col-md-3">
          <div class="panel">
              
              <div class="panel-body">
                <hr>
                <form  class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-6"><b>Secondary Name  :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->sname}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Designation:</b></label>
                    <div class="col-sm-6">
                     {{$viplead->sdesg}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Passport Number:</b></label>
                    <div class="col-sm-6">
                    {{$viplead->spassport}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Email :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->semail}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6"><b>Mobile :</b></label>
                    <div class="col-sm-6">
                     {{$viplead->smobile}}
                    </div>
                  </div>
  
                  <hr>


                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->

        </div><!-- col-md-6 -->
   
      </div><!--row -->
       
                                        @endforeach

                                        
 <?php
}
?>

<?php
if(count($editlead)==0){
?>
                <form action="{{ url('/initiator/bookingform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="leadid" value="{{$leadedit->leadcode}}">
                                      <input type="hidden" name="dealid" value="{{$leadedit->Id}}">
                                 
                                          @endforeach
                                            <input type="hidden" name="fromemail" id="pemail" value="{{$en->email}}">
                                            <input type="hidden" name="empid" id="" value="{{$en->emp_ide_id}}">

                                        <div class="form-group">
                                        <label class="col-md-4 control-label">Logo Status</label>
                                        <div class="col-md-4">
                                        <select name="logo" class="form-control" style="width:100%">
                                        <option value="">--Select--</option>
                                        <option value="Received and Approved">Received and Approved</option>
                                        <option value="Received and Pending">Received and Pending</option>
                                         <option value="Not Received">Not Received</option>
                                     
                                      </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                                 <label class="col-md-4 control-label">Client Name</label>
                                        <div class="col-md-4 "><input type="text" name="clientname" class="form-control" autocomplete="off" placeholder="Please Enter Primary Delegate Name"></div>
                                       
                                        </div>
                                      <div class="form-group">
                                                 <label class="col-md-4 control-label">Send VIP booking form</label>
                                        <div class="col-md-4 "><input type="email" name="vip_email" class="form-control" autocomplete="off" placeholder="Please Enter Primary Delegate Email"></div>
                                       
                                        </div>



                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Send</button>
                                        </div>
                                        </div>
                                
                                      
</form>
<?php
}
?>


 <div class="form-group">
                                       <div class="col-md-6">
                                       @foreach($editlead as $deal)
                                       @foreach($delegateinfo as $dealinfo)
                                       <?php
                                       if(($deal->status=='1')&&($dealinfo->vip=='1')){
                                       ?>
                                    <span style="color:green"> VIP Booking Form  Approved </span>
                                     <?php
                                      } if(($deal->status=='0')&&($dealinfo->vip=='NULL')){
                                       ?>
                                        <span style="color:orange">VIP Booking Form Rejected and waiting for to refill by client</span>
                                       <?php
                                      } if(($deal->status=='NULL')&&($dealinfo->vip=='NULL')){
                                       ?> 
                                       <input type="hidden" name="pemail" id="pemail" value="{{$viplead->pemail}}">
                                        <input type="hidden" name="leadcode" id="leadcode" value="{{$viplead->leadcode}}">
                                             <a class="btn btn-success  invoiceapprove" href="" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $viplead->id ?>">
                <i class="glyphicon glyphicon-thumbs-up icon-white"></i>
                Approve
            </a>
                <a class="btn btn-danger invoicereject" href="" data-toggle="modal"  data-target="#rejectModal" id="action_<?php echo $viplead->id ?>">
                <i class="glyphicon glyphicon-thumbs-down icon-white"></i>
              Reject
            </a>
           
            <?php
            }
            ?>
                <input type="hidden" name="pemail" id="email" value="{{$viplead->email}}">
                   <input type="hidden" name="empid" id="empid" value="{{$viplead->empid}}">
                   <input type="hidden" name="leadcode" id="leadcode" value="{{$viplead->leadcode}}">
             <a   class="btn btn-info " target="_blank"  alt="View" title="View" href="{{ URL::to('/initiator/vipbookingform', array('vip_id' => $deal->leadcode)) }}"><i class="fa fa-eye"></i> View</a>
             <a   class="btn btn-primary  resend "  href="" data-toggle="modal"  data-target="#resendModal" id="action_<?php echo $viplead->id ?>"><i class="fa fa-repeat"></i> Resend Link</a>
            @endforeach
            @endforeach
                 
                                        </div>
                                    
                                        </div>

            </div>
            <div class="tab-pane" id="recent5">
       
            </div>
              
            
              
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
    <div class="modal bounceIn animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Approve</h3>
                </div>
                <form action="{{ url('/initiator/accpetvip') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to approve ?</p>
                             <table width="100%"  class="table">
                                 <input type="text" name="accvipid" id="eventDel"  value=""/>
                                  <input type="text" name="email" id="eventId"  value=""/>
                                  <input type="text" name="leadcode" id="leadcode"  value=""/>
                                  <input type="text" name="approve_status" value="1"/>
                             </table>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" name="submit">Yes</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
            </div>
        </div>
    </div>
<!--resend delegate confirmation form -->
    <div class="modal bounceIn animated" id="resendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                 
                </div>
                <form action="{{ url('/initiator/resenddelegateform') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to resend ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="accvipid" id="resendDel"  value=""/>
                        <input type="hidden" name="email" id="resendemail"  value=""/>
                                            <input type="hidden" name="leadcode" id="leadcode"  value=""/>
                                
                             </table>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" name="submit">Yes</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--resend confirmation booking form-->

    <div class="modal bounceIn animated" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Reject</h3>
                </div>
                <form action="{{ url('/initiator/rejectvip') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to Reject ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="rejid" id="invoiceRej"  value=""/>
                                 <input type="hidden" name="email" id="eventId"  value=""/>
                                     <input type="hidden" name="empid" id="empid"  value=""/>
                                  <input type="hidden" name="leadcode" id="leadcode"  value=""/>
                                  <input type="hidden" name="reject_status" value="0"/>
                                  <textarea class="form-control" name="reject_comment" placeholder="Reject with Comments"></textarea>
                             </table>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" name="submit">Yes</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                </div>
            </form>
            </div>
        </div>
    </div>
<script type="text/javascript">


$('.invoiceapprove').click(function(e) {
 
   var approveid , approve,pemail;
   approveid =$(this).attr('id');
   approve =approveid.split('_');
   approveid=approve[1];
   
    var pemail= document.getElementById('pemail').value;
     var leadc= document.getElementById('leadcode').value;
 
    $("#myModal #eventDel").val( approveid );
     $("#myModal #eventId").val( pemail);
       $("#myModal #leadcode").val( leadc);
    
});
  

</script>
<script type="text/javascript">

$('.resend').click(function(e) {
 
   var reid , resendc,email;
   reid =$(this).attr('id');
   resendc =reid.split('_');
   reid=resendc[1];
   
    var email= document.getElementById('email').value;
     var releadc= document.getElementById('leadcode').value;
 
    $("#resendModal  #resendDel").val( reid );
     $("#resendModal  #resendemail").val( email);
       $("#resendModal  #leadcode").val(releadc);
    
});

</script>
<script type="text/javascript">


$('.invoicereject').click(function(e) {
 
   var rejectid , reject;
   rejectid =$(this).attr('id');
   reject =rejectid.split('_');
   rejectid=reject[1];
    var pemail= document.getElementById('pemail').value;
     var leadc= document.getElementById('leadcode').value;
       var empid= document.getElementById('empid').value;
   
    $("#rejectModal #invoiceRej").val( rejectid );
    $("#rejectModal #eventId").val( pemail);
       $("#rejectModal #leadcode").val( leadc);
         $("#rejectModal #empid").val( empid);
});
  

</script>
<script>
$(function() {

  // Textarea Auto Resize
  autosize($('#autosize'));

  // Select2 Box
  $('#select1, #select2, #select3').select2();
  $("#select4").select2({ maximumSelectionLength: 2 });
  $("#select5").select2({ minimumResultsForSearch: Infinity });
  $("#select6").select2({ tags: true });

  // Toggles
  $('.toggle').toggles({
    on: true,
    height: 26
  });

  // Input Masks
  $("#date").mask("99/99/9999");
  $("#phone").mask("(999) 999-9999");
  $("#ssn").mask("999-99-9999");

  // Date Picker
  $('.dob').datepicker(
    { dateFormat: 'yy-mm-dd',
     minDate: '0', }
    );
  $('.condate').datepicker(
    { dateFormat: 'yy-mm-dd',
      maxDate: '0', }
    );
  $('#datepicker-inline').datepicker();
  $('#datepicker-multiple').datepicker({ numberOfMonths: 2 });

  // Time Picker
  $('#tpBasic').timepicker();
  $('#tp2').timepicker({'scrollDefault': 'now'});
  $('#tp3').timepicker();

  $('#setTimeButton').on('click', function (){
    $('#tp3').timepicker('setTime', new Date());
  });

  // Colorpicker
  $('#colorpicker1').colorpicker();
  $('#colorpicker2').colorpicker({
    customClass: 'colorpicker-lg',
    sliders: {
      saturation: {
        maxLeft: 200,
        maxTop: 200
      },
      hue: { maxTop: 200 },
      alpha: { maxTop: 200 }
    }
  });

});
$(document).ready(function() {

  'use strict';

    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
 

});
</script>

@endsection
