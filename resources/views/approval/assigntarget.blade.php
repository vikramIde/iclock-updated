@extends('app')

@section('content')

    <section>

  <div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->


      <div class="tab-content">

        <!-- ################# MAIN MENU ################### -->

        <div class="tab-pane active" id="mainmenu">
         

          <h5 class="sidebar-title">Main Menu</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <?php if(Auth::User()->role=='director'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('approval/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent active">
              <a  href=""><i class="fa fa-check-square"></i><span>Assign Target</span></a>
             <ul class="children">
                <li class="active"><a  href="{{URL::to('approval/assigntarget')}}"><i class="fa fa-check-square"></i><span> Assign Target</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent">
              <a  href=""><i class="fa fa-plus-square"></i><span>Add New Sales User</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('approval/adduser')}}"><i class="fa fa-plus-square"></i><span> Add New Sales User</span></a></li>
            
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

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a ><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a >Dashbord</a></li>
        <li class="active">Assign target</li>
      </ol>

     

      <div class="row">

             <div class="col-md-12">

         
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Add Target</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>View Employee Targets</strong></a></li>
              <li><a href="#comments5" data-toggle="tab"><strong>Score Card Of Employees</strong></a></li>
          
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
              
                 <form action="{{ url('/approval/targetassign') }}" method="post"  class="form-horizontal" enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group">
                    <label class="col-md-4 control-label">Employee Name</label>
                    <div class="col-md-4">
                         <select name="employeeid" class="form-control" style="width:100%">
                        <option value="">--Select--</option>

                         @foreach($employee as $emp)

                    <option value="{{$emp->emp_ide_id}}|{{$emp->emp_name}}">{{$emp->emp_name}}</option>
                     @endforeach
                     </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-md-4 control-label"> Event Name</label>
                    <div class="col-md-4">
                           <select name="eventname" class="form-control" style="width:100%">
      <option value="">--Select--</option>

     @foreach($categories as $cat)
<option value="{{$cat->eventcode}}|{{$cat->event}}">{{$cat->event}}</option>
 @endforeach
 </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-md-4 control-label"> Target Value</label>
                    <div class="col-md-4">
                          <input type="text" class="form-control" name="target_value">
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-md-4 control-label"> Target Currency</label>
                    <div class="col-md-4">
                          <select class="form-control" name="currency" style="width:100%">
    <option value="">--Select--</option>
    <option value="INR">INR</option>
    <option value="EURO">EURO</option>
    <option value="USD">USD</option>
    
  </select>
                    </div>
                    </div>
                        <div class="form-group">
                    <label class="col-md-4 control-label"> Due date for Completion</label>
                    <div class="col-md-4">
                          <input type="text" class="form-control dp dob" name="target_date">
                    </div>
                    </div>
                      <div class="form-group">
                    <label class="col-md-4 control-label"> Mode of Target</label>
                    <div class="col-md-4">
                         <select class="form-control" name="modeoftarget" style="width:100%">
    <option>--Select--</option>
    <option value="Daily">Daily</option>
    <option value="Weekly">Weekly</option>
    <option value="Fortnight">Fortnight</option>
    <option value="Monthly">Monthly</option>
    <option value="Quarterly">Quarterly</option>
    <option value="Annual">Annual</option>
  </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                    </div>
                                               
   </form>
              
               
            </div>
            <div class="tab-pane" id="recent5">
              <div class="table-responsive">
                       <table id="dataTable1" class="table table-bordered table-striped-col">
                                      <thead>
                                        <tr>
                                              <th>Event Code</th>
                                              <th>Event Name</th>
                                              <th>Emp Id</th>
                                               <th>Emp Name</th>
                                             <th>Target Assigned</th>
                                              <th>Date of Assign</th>
                                              <th>Due date for completion</th>
                                              <th>No of days given to achive</th>
                                              <th>Action</th>
                                        
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($targets as $emptarget)
                                        <tr>
                                           <td>{{$emptarget->Eventcode}}</td> 
                                          <td style="width:170px">{{$emptarget->Eventname}}</td>
                                           <td>{{$emptarget->Employeeid}}</td>
                                           <td>{{$emptarget->Empname}}</td>

                                       
                                           <td style="text-align:right">{{$emptarget->Targetvalue}}</td>
                                           <td style="width:80px">{{$emptarget->Targetassigned}}</td>
                                           <td style="width:80px">{{$emptarget->Targetdate}}</td>

                                           <td style="width:50px"><?php
                                           
                                            $diff=strtotime($emptarget->Targetdate)-strtotime($emptarget->Targetassigned);
                                            $days=floor($diff/(60*60*24));
                                            echo $days;

                                           
                                           ?></td>
                                              <td class="center">
                                                                               
                <a class="btn btn-info employee btn-block" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $emptarget->Id ?>"  href="">
                <i class="fa fa-pencil"></i>
                Edit
            </a>
            <a class="btn btn-warning btn-block"href="">
             <i class="fa fa-print"></i>
                Print
            </a>
            
        
                                                                            </td>

                                      
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                       
               </div>
            </div>
             <div class="tab-pane" id="comments5">
              <div class="table-responsive">

                <table align="right">
                                          <tr>
                                            <td>   <button id="downloadIntermidiate" class="btn btn-success">Download Excel</button></td>
                                          </tr>
                                        </table>
                                      </br>
                                        </br>


                                        <table class="table table-bordered table-striped-col" id="scorecard">
                                      <thead >
                                              <tr class="noExl">
                                                <th>Event Code</th>
        
                                              <th>Event  Name</th>
                                         <!--  <td>Employee Name</td> -->
                                              <th>Employee Id</th>
                                              <th>Target Value</th>
                                              <th>Acheived</th>
                                               <th>Variance</th>
                                                <th>Currency</th>
        
        <!-- <td>Days Left</td> -->
    </tr>
                                       </thead>
                                                                <tbody>
      @foreach($userdata as $val)
     <tr>
      @foreach($val as $key=>$xx)
       <?php if($key=='variance' ) {
                        if($xx<0)
                          $color='red';
                        else
                          $color='green';

                      ?><td style="color:<?php echo $color; ?>;text-align:right"><?php   echo $xx ?></td><?php
       } 
       else 
       {
         ?><td ><?php   echo $xx ?></td> <?php } ?>
         
       @endforeach
     </tr>
     @endforeach
  </tbody>

  
 </table>
              </div>
            </div>
            
          </div>
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
<script type="text/javascript">


$('.employee').click(function(e) {
 
   var actoinid , nId,tableid,eventcode,eventname,employeeid,targetvalue,dateofassign,duedate;
   actoinid =$(this).attr('id');
   nId =actoinid.split('_');
   tableid=nId[1];

  eventcode = $(this).closest("tr").find('td:eq(0)').text();
  eventname = $(this).closest("tr").find('td:eq(1)').text();
  employeeid = $(this).closest("tr").find('td:eq(2)').text();
   targetvalue = $(this).closest("tr").find('td:eq(3)').text();
  dateofassign = $(this).closest("tr").find('td:eq(4)').text();
   duedate = $(this).closest("tr").find('td:eq(5)').text();
  
   
  
    $("#myModal #bookId").val( tableid );
    $("#myModal #eventcode").val( eventcode );
    $("#myModal #eventname").val( eventname );
  
    $("#myModal #employeeid").val( employeeid );
    $("#myModal #targetvalue").val( targetvalue );
    $("#myModal #dateofassign").val( dateofassign );
     $("#myModal #duedate").val( duedate );

 
  
});
  

</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Target</h3>
                        </div>
                        <form action="{{ url('/approval/updatetargetassign') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="targetid" id="bookId"  value=""/>
                              <tr><td>Event Code</td><td>  <input type="text" class="form-control" name="eventcode" id="eventcode" value="" disabled/></td></tr>
                              <tr><td>Event Name</td><td><input type="text" class="form-control" name="eventname" id="eventname" value="" disabled/></td></tr>
                              <tr><td>Emp Id</td><td><input type="text" class="form-control" name="employeeid" id="employeeid" value="" disabled/></td></tr>
                             <tr><td>Target Assigned</td><td><input type="text" class="form-control " name="targetvalue" id="targetvalue" value=""/></td></tr>
                               <tr><td>Date Of Assign</td><td><input type="text" class="form-control " name="dateofassign" id="dateofassign" value="" disabled/></td></tr>
                                  <tr><td>Due Date for Completion</td><td><input type="text" class="form-control dob" name="duedate" id="duedate" value=""/></td></tr>
                             </table>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
    { dateFormat: 'dd-mm-yy',
     minDate: '0', }
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

<script src="{{asset('/js/jquery.table2excel.js')}}"></script>
<script>
      $(function() {
                  $("#downloadIntermidiate").click(function(){

                        $("#scorecard").table2excel({
                              exclude: ".noExl",
                        name: "Excel Document intermediateTable"
                        }); 
                        
                         });
                 
              
            });
</script>
@endsection