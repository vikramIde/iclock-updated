@extends('app')

@section('content')
<!-- <script type='text/javascript' src="{{asset('js/jquery-1.11.2.min.js')}}"></script> -->
<section>

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
              <a href="{{ URL::to('initiator/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a>
           <ul class="children">
                <li  class="active"><a  href="{{ URL::to('initiator/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
                <li class="nav-parent active">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li class="active"><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                 <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs</span></a></li>
                  <li><a href="{{ URL::to('initiator/dealclose')}}"><i class="fa fa-line-chart"></i><span> Pending for  Deal Closed</span></a></li>
                   <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>
               
              </ul>
            </li>
           <li class="nav-parent ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>
             
             <ul class="children">
                <li><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
                  <li><a  href="{{ URL::to('initiator/deals')}}"><i class="fa fa-pencil-square-o"></i><span> My Deals</span></a></li>
            
              </ul>
            </li>
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
        
            <?php } ?>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Call Back Sheet</strong></a></li>
           
           
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">

            <div class="tab-pane active" id="popular5"> 
             @foreach($lead_id as $leadname)
             <center><h5><u>Company Information</u></h5></center>
             <table class="table">
              <thead>
                <tr>
                  <th>Company Name</th>
                  <th>Product Category</th>
                  <th>Board Line</th>
                  <th>Fax</th>
                  <th>Partnership Package Name</th>
                  <th>Partnership Package Value</th>
                </tr>
              </thead>
                 <tbody>
                <tr>
                  <th> {{$leadname->company_name}}</th>
                  <th> {{$leadname->product_category}}</th>
                  <th> {{$leadname->phone}}</th>
                  <th>{{$leadname->other_office}}</th>
                  <th> {{$leadname->partnership_package_name}}</th>
                  <th>{{$leadname->partnership_package_value}}</th>
                </tr>
              </tbody>
             </table>
   
               <center><h5><u>Decision Maker</u></h5></center>
               <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Direct Line</th>
                  <th>Email</th>
                  <th>Designation</th>
                  <th>Mobile</th>
                  <th>Alternate Number</th>
                </tr>
              </thead>
                 <tbody>
                <tr>
                  <th> {{$leadname->dmname}}</th>
                  <th> {{$leadname->dmphone}}</th>
                  <th>{{$leadname->dmemail}}</th>
                  <th> {{$leadname->dmdesignation}}</th>
                  <th>  {{$leadname->dmmobile}}</th>
                  <th>{{$leadname->dmaltnumber}}</th>
                </tr>
              </tbody>
             </table>
   
             <center><h5><u>Influencer</u></h5></center>
             <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Direct Line</th>
                  <th>Email</th>
                  <th>Designation</th>
                  <th>Mobile</th>
                  <th>Alternate Number</th>
                </tr>
              </thead>
                 <tbody>
                <tr>
                  <th>{{$leadname->infname}}</th>
                  <th> {{$leadname->infphone}}</th>
                  <th>{{$leadname->infemail}}</th>
                  <th>{{$leadname->infdesignation}}</th>
                  <th> {{$leadname->infmobile}}</th>
                  <th> {{$leadname->infaltnumber}}</th>
                </tr>
              </tbody>
             </table>
   
             <center><h5><u>Specifier</u></h5></center>
              <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Direct Line</th>
                  <th>Email</th>
                  <th>Designation</th>
                  <th>Mobile</th>
                  <th>Alternate Number</th>
                </tr>
              </thead>
                 <tbody>
                <tr>
                  <th>{{$leadname->specname}}</th>
                  <th>  {{$leadname->specphone}}</th>
                  <th>{{$leadname->speemail}}</th>
                  <th>{{$leadname->specdesignation}}</th>
                  <th> {{$leadname->spemobile}}</th>
                  <th> {{$leadname->spealtnumber}}</th>
                </tr>
              </tbody>
             </table>
    
             <center><h5><u>Remarks</u></h5></center>
             <table class="table">
              <thead>
                <tr>
                  <th>Remarks</th>
                  <th>Competitors</th>
                
                </tr>
              </thead>
                 <tbody>
                <tr>
                  <th>  {{$leadname->remarks}}</th>
                  <th>  {{$leadname->competitors}}</th>
                  
                </tr>
              </tbody>
             </table>
 
          
</br>
            @endforeach
 @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach
                                       <center><h5><u>Previous Call History</u></h5></center>
                 <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr >
                                                                      <th>Lead ID</th>
                                                                      <th>Emp Id & Name</th>
                                                                      <th>Time of call</th>
                                                                      <th>Results</th>
                                                                      <th>Next call Date & Time</th>
                                                                      <th>Schedule</th>
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($leadscallback as $leadcall)
                                                                  <tr>
                                                                    <th>{{$leadcall->leadcode}}</th>
                                                                      <th>{{$leadcall->empid}}-{{$leadcall->empname}}</th>
                                                                   <th><?php
                                                                   $time=$leadcall->timeofcall;
                                                                    $timef=date('h:i:s a', strtotime($time));
                                                                    echo $timef;
                                                                   ?></th>
                                                                      <th>{{$leadcall->results}}</th>
                                                                      <th>
                                                                        <?php
                                                                   $time=$leadcall->nextcalldate;
                                                                    $timef=date('h:i:s a : m-d-Y', strtotime($time));
                                                                    echo $timef;
                                                                   ?></th>
                                                                      <th>{{$leadcall->schedule}}</th>
                                                                  </tr>
                                                                  @endforeach
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                        </br>
<?php 

if($leadname['callback']=='0'){

  ?>


<div>


                                                        <center><h4><u>CALL BACK MANAGEMENT</u></h4></center>
                                                      </br>
                <form action="{{ url('/initiator/callbackform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                         <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                         <div class="form-group">
                                        <label class="col-md-2 control-label">  Time of call</label>
                                        <div class="col-md-2">
                                           <input id="tpBasic" type="text" name="timeofcall" class="form-control"/>
                                        </div>
                                        <div class="col-md-2">
                                            
                                           

                                        </div>
                                         <label class="col-md-2 control-label"> Results</label>
                                        <div class="col-md-2">
                                          <textarea class="form-control" name="results"></textarea>
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-2 control-label"> Next Call Date</label>
                                        <div class="col-md-2">
                                             <input type="text" class="form-control dob"  autocomplete="off" name="nextcalldate">

                                           
                                        </div>
                                        <div class="col-md-2">
                                            
                                            <input id="tp2" type="text" name="nexttime" class="form-control"/>

                                        </div>
                                         <label class="col-md-2 control-label">  Schedule </label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" name="schedule"></textarea>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        </div>
                                        </div>
                                
                                      
</form>
</br>
<div class="row">
  <div class="col-md-6">
       <center><h4><u>CALL BACK ASSIGN</u></h4></center>
                                                      </br>
                <form action="{{ url('/initiator/callbackassign') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                   <div class="form-group">
                                        <label class="col-md-3 control-label"> Assign call back to</label>
                                        <div class="col-md-4">

                                           <?php
                              if($en->emp_department=='Vendors')
                              {
                                ?>
                                          <select class="form-control" name="assignedid">
                                          <option value="NULL">Select</option>
                                           @foreach($salesman_list as $list)
                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>
                                           @endforeach
                                          </select>

                                          <?php
               } else{
                ?>
                  <select class="form-control" name="assignedid">
                                          <option value="NULL">Select</option>
                                           @foreach($dellist as $list)
                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>
                                           @endforeach
                                          </select>

                                              <?php 
               }
                  ?>
                                        </div>
                                        <div class="col-md-2">
                                            
                                            <input type="submit" class="btn btn-primary" name="submit" value="Assign">

                                        </div>
                                        
                                        </div>
                                   
                                
                                      
</form>
  </div>
  <div class="col-md-6">
              <center><h4><u>DEAL CLOSE</u></h4></center>
                                                      </br>
                                                      <div class="form-group">
                                        <label class="col-md-3 control-label"> </label>
                                        <div class="col-md-3">
                                                 <form action="{{ url('/initiator/dealclosing') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                  <input type="submit" class="btn btn-primary" name="submit" value="Deal Close">
                                  
</form>
                                        </div>
                                        <div class="col-md-3">
                                            
                                       <form action="{{ url('/initiator/blowoutdeal') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                  <input type="submit" class="btn btn-primary" name="submit" value="Blow Out">
                                   
                                
                                      
</form>

                                        </div>
                                        
                                        </div>
      
  </div>
</div>


</div>

<?php
}  

elseif($leadname['callbackassignid']==$en['empid']){
?>


<div>


                                                        <center><h4><u>CALL BACK MANAGEMENT</u></h4></center>
                                                      </br>
                <form action="{{ url('/initiator/callbackform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                      <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                         <div class="form-group">
                                        <label class="col-md-2 control-label">  Time of call</label>
                                        <div class="col-md-2">
                                           <input id="tpBasic" type="text" name="timeofcall" class="form-control"/>
                                        </div>
                                        <div class="col-md-2">
                                            
                                           

                                        </div>
                                         <label class="col-md-2 control-label"> Results</label>
                                        <div class="col-md-2">
                                          <textarea class="form-control" name="results"></textarea>
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-2 control-label"> Next Call Date</label>
                                        <div class="col-md-2">
                                             <input type="text" class="form-control dob"  autocomplete="off" name="nextcalldate">

                                           
                                        </div>
                                        <div class="col-md-2">
                                            
                                            <input id="tp2" type="text" name="nexttime" class="form-control"/>

                                        </div>
                                         <label class="col-md-2 control-label">  Schedule </label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" name="schedule"></textarea>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        </div>
                                        </div>
                                
                                      
</form>
</br>
  <div class="row">
  <div class="col-md-6">
       <center><h4><u>CALL BACK ASSIGN</u></h4></center>
                                                      </br>
                <form action="{{ url('/initiator/callbackassign') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                   <div class="form-group">
                                        <label class="col-md-3 control-label"> Assign call back to</label>
                                        <div class="col-md-4">
                                          
                                           <?php
                              if($en->emp_department=='Vendors')
                              {
                                ?>
                                          <select class="form-control" name="assignedid">
                                          <option value="NULL">Select</option>
                                           @foreach($salesman_list as $list)
                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>
                                           @endforeach
                                          </select>

                                          <?php
               } else{
                ?>
                  <select class="form-control" name="assignedid">
                                          <option value="NULL">Select</option>
                                           @foreach($dellist as $list)
                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>
                                           @endforeach
                                          </select>

                                              <?php 
               }
                  ?>
                                        </div>
                                        <div class="col-md-2">
                                            
                                            <input type="submit" class="btn btn-primary" name="submit" value="Assign">

                                        </div>
                                        
                                        </div>
                                   
                                
                                      
</form>
  </div>
  <div class="col-md-6">
       <center><h4><u>DEAL CLOSE</u></h4></center>
                                                      </br>
                                                      <div class="form-group">
                                        <label class="col-md-3 control-label"> </label>
                                        <div class="col-md-3">
                                                 <form action="{{ url('/initiator/dealclosing') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                  <input type="submit" class="btn btn-primary" name="submit" value="Assign Deal Close">
                                   
                                
                                      
</form>
                                        </div>
                                        <div class="col-md-3">
                                            
                                                     <form action="{{ url('/initiator/blowoutdeal') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">
                                        
                                          @endforeach
                                          @foreach($evarr as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">
                                      @endforeach

                                  <input type="submit" class="btn btn-primary" name="submit" value="Blow Out">
                                   
                                
                                      
</form>

                                        </div>
                                        
                                        </div>
      
  </div>
</div>

</div>
<?php 
}
elseif(($leadname['empid']==$en['empid'])&& ($leadname['dealclose']=='1')){
?>
<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for deal close '; echo ' '; echo 'by'; echo ' '; echo '"';
echo $leadname['dealclosebyid']; echo ' ';echo '-';  echo ' ';echo $leadname['dealclosebyname']; echo '"'; echo'</strong>';?>


<?php 
}
elseif(($leadname['empid']==$en['empid'])&& ($leadname['blowout']=='1')){
?>
<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for deal close '; echo ' '; echo 'by'; echo ' '; echo '"';
echo $leadname['blowoutbyid']; echo ' ';echo '-';  echo ' ';echo $leadname['blowoutbyname']; echo '"'; echo'</strong>';?>

<?php
}
else{
  ?>
<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for callback '; echo ' '; echo 'to'; echo ' '; echo '"';
echo $leadname['callbackassignid']; echo ' ';echo '-';  echo ' ';echo $leadname['callbackassignname']; echo '"'; echo'</strong>';?>

<?php
}
?>

            </div>
      
              
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>


<script>

$(document).ready(function() {

  'use strict';

    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
 



  $('.dob').datepicker(
    { dateFormat: 'yy-mm-dd',
     minDate: '0', }
    );
   // Time Picker
  $('#tpBasic').timepicker(
    {

    
          });
  $('#tp2').timepicker({'scrollDefault': 'now'});
  $('#tp3').timepicker();

  $('#setTimeButton').on('click', function (){
    $('#tp3').timepicker('setTime', new Date());
  });

});
</script>

@endsection
