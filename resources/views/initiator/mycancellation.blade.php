@extends('app')

@section('content')

<section>
@foreach($edetails as $en)

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
           <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li ><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                   <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li ><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs </span></a></li>
                <li><a href="{{ URL::to('initiator/dealclose')}}"><i class="fa fa-line-chart"></i><span> Pending for  Deal Closed</span></a></li>
                 <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>
             
              </ul>
            </li>
         <li class="nav-parent active ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
                  <li><a  href="{{ URL::to('initiator/deals')}}"><i class="fa fa-pencil-square-o"></i><span> My Deals</span></a></li>
                        <?php
                              if($en->emp_department=='Delegates')
                              {
                                ?>
                   <li ><a  href="{{ URL::to('initiator/pendingactivity')}}"><i class="fa fa-pencil-square-o"></i><span> My Pending Activity</span></a></li>
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
        <li><a><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a >Dashbord</a></li>
        <li class="active">Update Event Deal</li>
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
           <!--  <li class="active"><a href="#popular5" data-toggle="tab"><strong>Update new deal</strong></a></li> -->
           
             <li class="active"><a href="#comments5" data-toggle="tab"><strong>Deal Cancelled <span style="color:red">( <?php echo count($dealcan) ?> )</span>   </strong></a></li>
              <li><a href="#comments6" data-toggle="tab"><strong>Deal and Invoice Cancelled <span style="color:red">( <?php echo count($invcancel) ?> )</span>   </strong></a></li>
       
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <!-- <div class="tab-pane active" id="popular5">

              <form action="{{ url('/initiator/dealinsert') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                        @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach
                                         <div class="form-group">
                                        <label class="col-md-4 control-label"> Client Name</label>
                                        <div class="col-md-4">
                                             <input type="text" name="clientname" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Company Name</label>
                                        <div class="col-md-4">
                                            <input type="text" id='q' name="company" autocomplete="on" class="form-control">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Event Name</label>
                                        <div class="col-md-4">
                                        <select name="eventname" class="form-control" style="width:100%">
                                        <option value="">--Select--</option>
                                       @foreach($empid as $e)
										<option value="{{$e->Eventcode}}|{{$e->Eventname}}">{{$e->Eventname}}</option>
                                       @endforeach
                                      </select>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Deal Date</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control  dob" autocomplete="off" name="dealdate">
                                        </div>
                                        </div>
                                          <div class="form-group">
                                        <label class="col-md-4 control-label">  Deal Value</label>
                                        <div class="col-md-4">
                                          <input type="text" class="form-control" autocomplete="off"  name="deal_value">
                                        </div>
                                        </div>
                                          <div class="form-group">
                                        <label class="col-md-4 control-label">  Deal Type</label>
                                        <div class="col-md-4">
                                          <select class="select2" name="deal_type" style="width:100%">
                                          <option value="">--Select--</option>
                                          <option value="annual">Annual</option>
                                          <option value="single">Single</option>
                                         
                                          
                                        </select>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Deal Currency</label>
                                        <div class="col-md-4">
                                          <select class="form-control" name="deal_curr" style="width:100%">
                                          <option value="">--Select--</option>
                                          <option value="INR">INR</option>
                                          <option value="EURO">EURO</option>
                                          <option value="USD">USD</option>
                                          
                                        </select>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Contract Sent Date</label>
                                        <div class="col-md-4">
                                          <input tyep="text" class="form-control condate " autocomplete="off" name="sent_date">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label"> Contract Received Date</label>
                                        <div class="col-md-4">
                                          <input tyep="text" class="form-control condate "  autocomplete="off"name="rec_date">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        </div>
                                        </div>
                                      
</form>

            </div> -->
   
                <div class="tab-pane active" id="comments5">
              <div class="table-responsive">
                        <table id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead>
                                                                    <tr>
																		  <th>Company Name</th>
                                                                          <th>Event Name</th>
                                                                          <th>Deal Date</th>
                                                                          <th>Deal Value</th>
                                                                          <th>Currency</th>
                                                                          <th>Deal Type</th>
                                                                          <th>Employee Id</th>
                                                                          <th>Status</th>
                                                                          <th>Approve</th>                          
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                          @foreach($dealcan as $dealcancel)
                                  <tr>
                                  <td>{{$dealcancel->Companyname}}</td>
                                  <td>{{$dealcancel->Eventname}}</td>
                                  <td>{{$dealcancel->Dealdate}}</td>
                                  <td style="text-align:right">{{$dealcancel->Dealvalue}}</td>
                                  <td>{{$dealcancel->Dealcurr}}</td>
                                  <td>{{$dealcancel->Dealtype}}</td>
                                  <td>{{$dealcancel->Empid}} - {{$dealcancel->Empname}}</td>
                                  <td style="color:red">
                                   {{$dealcancel->Status}}
                                  </td>
                                  <td>
                                   
                                 <a href=""  class="btn btn-success btn-block  YES"  data-toggle="modal"  id="event_<?php echo $dealcancel->Id ?>" data-target="#YesModal">Yes</a>
                                 <a href="" class="btn btn-danger btn-block  NO" data-toggle="modal"  id="event_<?php echo $dealcancel->Id ?>" data-target="#NoModal">No</a>
                                  
                                  </td>
                                  </tr>
                                  @endforeach

                                                                </tbody>
                                                            </table>
                                                          </div>
            </div> 


<div class="tab-pane" id="comments6">
              <div class="table-responsive">
          
                        <table id="dataTable3" class="table table-bordered table-striped-col">
                                                                <thead>
                                                                    <tr>
                                                                           <th>Company Name</th>
                                                                          <th>Event Name</th>
                                                                          <th>Deal Date</th>
                                                                          <th>Deal Value</th>
                                                                          <th>Currency</th>
                                                                          <th>Deal Type</th>
                                                                         
                                                                          <th>Status</th>
                                                                          <th>Approve</th>                          
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                          @foreach($invcancel as $invcan)
                                  <tr>
                                  <td>{{$invcan->Companyname}}</td>
                                  <td>{{$invcan->Eventname}}</td>
                                  <td>{{$invcan->Dealdate}}</td>
                                  <td style="text-align:right">{{$invcan->Dealvalue}}</td>
                                  <td>{{$invcan->Dealcurr}}</td>
                                  <td>{{$invcan->Dealtype}}</td>
                                 
                                  <td style="color:red">
                                   {{$invcan->Status}}
                                  </td>
                                  <td>
                                   
                                 <a href=""  class="btn btn-success btn-block YES"  data-toggle="modal"  id="event_<?php echo $invcan->Id ?>" data-target="#YesModal">Yes</a>
                                 <a href="" class="btn btn-danger btn-block  NO" data-toggle="modal"  id="event_<?php echo $invcan->Id ?>" data-target="#NoModal">No</a>
                                  
                                  </td>
                                  </tr>
                                  @endforeach

                                                                </tbody>
                                                            </table>
                                                          </div>
            </div> 
<script type="text/javascript">
            $('.YES').click(function(e) {

            var delid , del;
            delid =$(this).attr('id');
            del =delid.split('_');
            del1=del[1];
            // alert(del1);

            $("#YesModal #yes").val( del1 );

            });
            $('.NO').click(function(e) {

            var delid , del;
            delid =$(this).attr('id');
            del =delid.split('_');
            del1=del[1];
            // alert(del1);

            $("#NoModal #no").val( del1 );

            });
			//Javascript
$(function()
{
	 $( "#q" ).autocomplete({
	  source: "/search/autocomplete?companyName=1",
	  minLength: 1,
	  select: function(event, ui) {
	  	$('#q').val(ui.item.value);
	  }
	});
});
</script>
              
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
       <div class="modal bounceIn animated" id="YesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Reject Deal</h3>
                        </div>
                        <form action="{{ url('/initiator/dealcancleyes') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                            <p>Are you want to Reject  the Deal ? </p>
                             <table width="100%"  class="table">
                              <tr><td>
                              <input type="text" class="form-control" name="dealid" id="yes"  value=""/>
                              <textarea name="comment" class="form-control"></textarea>
                               </td></tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
                   <div class="modal bounceIn animated" id="NoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Reject Deal</h3>
                        </div>
                        <form action="{{ url('/initiator/dealcancleno') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                            <p>Are you want to Reject  the Deal ?</p>
                            <table width="100%"  class="table">
                              <tr><td>
                              <input type="text" name="dealid" id="no"  value=""/>
                              <textarea name="comment" class="form-control"></textarea>
                            </td></tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>

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

  $('.table tr td:first-child input[type=checkbox]').each(function() {
    checkRow($(this));
  });

  $('.table tr td:first-child input[type=checkbox]').click(function() {
    checkRow($(this));
  });


});
$(document).ready(function() {

  'use strict';

  $('#dataTable1').DataTable();
    $('#scorecard').DataTable();
      $('#dataTable3').DataTable();
  // Select2
  $('select').select2({ minimumResultsForSearch: Infinity });

});

</script>


@endsection
