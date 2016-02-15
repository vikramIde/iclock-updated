@extends('app')

@section('content')

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
           <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li class="active"><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                   <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li ><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs </span></a></li>
                <li><a href="{{ URL::to('initiator/dealclose')}}"><i class="fa fa-line-chart"></i><span> Pending for  Deal Closed</span></a></li>
                 <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>
             
              </ul>
            </li>
         <li class="nav-parent active ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
                  <li><a  href="{{ URL::to('initiator/deals')}}"><i class="fa fa-pencil-square-o"></i><span> My Deals</span></a></li>
            
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
        
            <?php }} ?>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Update new deal</strong></a></li>
         
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">

              <form action="{{ url('/initiator/dealinsert') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                        @foreach($emp as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
                                       <input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
                                      @endforeach
                                           @foreach($leadid as $lead)
                                      <input type="hidden" name="leadid"  autocomplete="off" value="{{$lead->id}}">
                                      <input type="hidden" name="leadcode"  autocomplete="off" value="{{$lead->leadcode}}">
                                      @endforeach
                        <?php
                              if($en->emp_department=='Vendors')
                              {
                                ?>
                                 
                                         <div class="form-group">
                                        <label class="col-md-4 control-label"> Client Name</label>
                                        <div class="col-md-4">
                                             <input type="text" name="clientname" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Company Name</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="company" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Event Name</label>
                                        <div class="col-md-4">
                                        <select name="eventname" class="form-control" style="width:100%">
                                        <option value="">--Select--</option>
                                       @foreach($cat as $e)
										<option value="{{$e->eventcode}}|{{$e->event}}">{{$e->event}}</option>
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
                                        <label class="col-md-4 control-label">  Billing Currency</label>
                                        <div class="col-md-4">
                                          <select class="form-control" name="deal_curr" style="width:100%">
                                          <option value="">--Select--</option>
                                          <option value="INR">INR</option>
                                          <option value="EURO">EURO</option>
                                          <option value="USD">USD</option>
                                          
                                        </select>
                                        </div>
                                        </div>
                 <?php
               }  elseif($en->emp_department=='Delegates'){
                ?>
                                                 <div class="form-group">
                                        <label class="col-md-4 control-label">  Company Name</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="company" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-4 control-label">  Event Name</label>
                                        <div class="col-md-4">
                                        <select name="eventname" class="form-control" style="width:100%">
                                        <option value="">--Select--</option>
                                       @foreach($cat as $e)
                    <option value="{{$e->event}}|{{$e->eventcode}}">{{$e->event}}</option>
                                       @endforeach
                                      </select>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                        <label class="col-md-4 control-label"> <b>Deleagate 1</b></label>
                                        <div class="col-md-4">
                                         
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-4 control-label"> Name</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="name[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                             <div class="form-group">
                                        <label class="col-md-4 control-label"> Mobile</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="mobile[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-4 control-label"> Email</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="email[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-4 control-label">Designation</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="desg[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                        <label class="col-md-4 control-label"> <b>Deleagate 2</b></label>
                                        <div class="col-md-4">
                                           
                                        </div>
                                        </div>
                                                <div class="form-group">
                                        <label class="col-md-4 control-label"> Name</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="name[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                             <div class="form-group">
                                        <label class="col-md-4 control-label"> Mobile</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="mobile[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-4 control-label"> Email</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="email[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-4 control-label">Designation</label>
                                        <div class="col-md-4">
                                            <input type="text"  name="desg[]" autocomplete="off" class="form-control">
                                        </div>
                                        </div>
                                        </div>
                                      </div>


                  <?php 
               }
                  ?>
                                
                                        <center><div class="form-group">
                                        <label class="col-md-4 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        </div>
                                        </div></center>
                                      
</form>

            </div>
 

        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
      


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
