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
            <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('approval/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent">
              <a  href=""><i class="fa fa-check-square"></i><span>Assign Target</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('approval/assigntarget')}}"><i class="fa fa-check-square"></i><span> Assign Target</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent">
              <a  href=""><i class="fa fa-plus-square"></i><span>Add New Sales User</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('approval/adduser')}}"><i class="fa fa-plus-square"></i><span>Add New Sales User</span></a></li>
            
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
        <li class="active">Home</li>
      </ol>

     

      <div class="row">

             <div class="col-md-12">

         
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Employee List</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>Add Employee</strong></a></li>
          
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
               <div class="table-responsive">
                 <table id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>
                                                                        <th>S.no</th>
                                                                        <th>Emp Name</th>
                                                                        <th>Emp Id</th>
                                                                        <th>Department</th>
                                                                         <th>Category</th>
                                                                         <th>Status</th>
                                                                        <th>Actions</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($employee as $emp)
                                                                  <tr>
                                                                  
                                                                  <td>{{$emp->emp_id}}</td>
                                                                  <td  >{{$emp->emp_name}}</td>
                                                                  <td>{{$emp->emp_ide_id}}</td>
                                                                  <td >{{$emp->emp_department}}</td>
                                                                  <td >{{$emp->cat}}</td>
                                                                  <td style="width:100px"><?php
            if($emp->emp_status=='Active')
            {
              ?>
               <span class="btn btn-success">
               
               {{$emp->emp_status}}
            </span>

              <?php
            }else {

              ?>
           <span class="btn btn-danger">
               {{$emp->emp_status}}
            </span>
              <?php
            
            }
            ?></td>
                                                                  <td class="center">
                                                                               
                <a class="btn btn-info employee" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $emp->emp_id ?>"  href="">
                 <i class="fa fa-pencil"></i>
                Edit
            </a>
            
        
            </td>
                                                                  
              </tr>
                 @endforeach

                   </tbody>

 <script type="text/javascript">


$('.employee').click(function(e) {
 
   var actoinid , nId,name,employe_id,department,empid;
   actoinid =$(this).attr('id');
   nId =actoinid.split('_');
   empid=nId[1];

  name = $(this).closest("tr").find('td:eq(1)').text();
  employe_id = $(this).closest("tr").find('td:eq(2)').text();
  department = $(this).closest("tr").find('td:eq(3)').text();
  
   
  
    $("#myModal #bookId").val( empid );
    $("#myModal #bookName").val( name );
    $("#myModal #bookemp_id").val( employe_id );
    $("#myModal #bookDept").val( department );
 
  
});
  

</script>

      </table>
              
               </div>
            </div>
            <div class="tab-pane" id="recent5">
              <div class="table-responsive">
                <form action="{{ url('/approval/addemployee') }}" method="post" >
                                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                          <table class="table table-bordered table-striped-col">
                                            <tr>
                                              <td>Name</td>
                                              <td><input type="text" name="empname" class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Id</td>
                                              <td><input type="text" name="empid"  class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Position</td>
                                              <td><input type="text" name="emppos" class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Department</td>
                                              <td><select class="form-control"  style="width:100%" name="empdept">
                                                <option>--Select--</option>
                                                <option value="CRM">CRM</option>
                                                <option value="Vendors">Vendors</option>
                                                <option value="Delegates">Delegates</option>
                                                <option value="Marketing">Marketing</option>
                                              </select></td>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
                                            </tr>
                                          </table>
                                         </form>
                       
               </div>
            </div>
            
            
          </div>
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Employee</h3>
                        </div>
                        <form action="{{ url('/approval/updateadmin') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="emp_id_d" id="bookId"  value=""/>
                              <tr><td>Name</td><td>  <input type="text" class="form-control" name="emp_name" id="bookName" value=""/></td></tr>
                              <tr><td>Id</td><td><input type="text" class="form-control" name="emp_id" id="bookemp_id" value=""/></td></tr>
                              <tr><td>Department</td><td><input type="text" class="form-control" name="emp_dept" id="bookDept" value=""/></td></tr>
                             <tr><td>Employee Staus</td><td><select name="emp_status" class="form-control" style="width:100%">
                              <option>--Select--</option>
                              <option value="Active"> Active</option>
                               <option value=" Resigned / Cessation"> Resigned / Cessation</option>
                                <option value="Transferred to non sales"> Transferred to non sales</option>
                              
                            </select></td></tr>
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
    $('#dataTable2').DataTable();
      $('#dataTable3').DataTable();
  // Select2
  $('select').select2({ minimumResultsForSearch: Infinity });

});
  $('.select2').select2();
</script>
@endsection