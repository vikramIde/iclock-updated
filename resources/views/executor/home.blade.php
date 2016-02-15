@extends('app')

@section('content')

       <script type="text/javascript">
            $(function () {
     $("#table-data").on('click', 'input.addButton', function () {
         var $tr = $(this).closest('tr');
         var allTrs = $tr.closest('table').find('tr');
         var lastTr = allTrs[allTrs.length - 1];
         var $clone = $(lastTr).clone();
         $clone.find('td').each(function () {
             var el = $(this).find(':first-child');
             var id = el.attr('id') || null;
               var name = el.attr('name') || null;
             if (id) {
                 var i = id.substr(id.length - 1);
                 var prefix = id.substr(0, (id.length - 1));
                 el.attr('id', prefix + (+i + 1));
                 el.attr('name', name);
             }
         });
         $clone.find('input:text').val('');
      $clone.find('.dob').removeAttr('id').removeClass('hasDatepicker');
         $clone.find('.dob').datepicker({
            dateFormat: 'yy-mm-dd',
           minDate: '0',

         });

         $tr.closest('table').append($clone);
     });

     // $("#table-data").on('change', 'select', function () {
     //     var val = $(this).val();
     //     $(this).closest('tr').find('input:text').val(val);
     // });

     
 });
        </script>
<section>

  <div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->


      <div class="tab-content">

        <!-- ################# MAIN MENU ################### -->

        <div class="tab-pane active" id="mainmenu">
         

          <h5 class="sidebar-title">Main Menu</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <?php if(Auth::User()->role=='admin1'){ ?>      
            <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('executor/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent">
              <a  href=""><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('executor/dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a></li>
            
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Master for events</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>Sales representative</strong></a></li>
            <li><a href="#comments5" data-toggle="tab"><strong>View invoice</strong></a></li>
             <li><a href="#comments6" data-toggle="tab"><strong>View all events</strong></a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
               <div class="table-responsive">
              <form action="{{ url('/executor/event') }}" method="post"  enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <table class="table table-bordered table-striped-col nomargin" id="table-data">
                                                    <tr align="center">
                                                        <td>Event Name</td>
                                                        <td>Event Code</td>
                                                        <td>Event Date</td>
                                                        <td>City</td>
                                                        <td>Country</td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="eventname[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="eventcode[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control dob"  autocomplete="off" name="date[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="city[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="country[]" >
                                                        </td>
                                                        <td>
                                                            <input type="button" class="btn btn-default addButton" value="Add" />
                                                        </td>
                                                    </tr>
                                                </table>
                                               </br>

                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            </form>
                                          </div>
            </div>
            <div class="tab-pane" id="recent5">
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
                                                                  <td  >{{$emp->emp_department}}</td>
                                                                  <td  >{{$emp->cat}}</td>
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
                                                                               
                <a class="btn btn-info employee btn-block" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $emp->emp_id ?>"  href="">
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
<script type="text/javascript">


$('.empdel').click(function(e) {
 
   var eventdelid , del;
   eventdelid =$(this).attr('id');
   del =eventdelid.split('_');
   eventdel1=del[1];
   
    $("#empdelModal #eventDel").val( eventdel1 );
    
});
  

</script>
                                                            </table>
                                                          </div>
            </div>
            <div class="tab-pane" id="comments5">
              <div class="table-responsive">
                        <table id="dataTable2" class="table table-bordered table-striped-col">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Deal Value</th>
                                                                        <th>Deal Currency</th>
                                                                        <th>Rc Value</th>
                                                                        <th>Status</th>
                                                                        <th>Rejected Comments</th>
                                                                        <th>Action</th>
                                                                                                                                
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  
                                                                   @foreach($invoice as $inv)
                                                                  <tr>
                                                                  
                                                                  <td>{{$inv->Id}}</td>
                                                                  <td style="width:120px">{{$inv->Companyname}}</td>
                                                                  <td style="width:120px">{{$inv->EventName}}</td>
                                                                  <td >{{$inv->RepresentativeNo}}-{{$inv->Repname}}</td>
                                                                  <td style="text-align:right">{{$inv->Amount}}</td>
                                                                  <td >{{$inv->CurrencyType}}</td>
                                                                  <td style="text-align:right">{{$inv->Rcvalue}}</td>
                                                               
                                                                  <td class="center">
            <?php
                                                        if($inv->Status =='1') {?>
                                              <span class="label label-success">Approved</span>
                                                            <?php
                                                        } if($inv->Status == '0'){?>
                                             <span class="label label-danger">Rejected</span>
                                                           <?php
                                                        }if($inv->Status == 'NULL')  {?>
                                                        <span class="label label-warning">Pending</span>
                                                        <?php
                                                    }
                                                    ?>
           
        </td>
        <td style="width:120px">{{$inv->RejectedwithComments}}</td>
            <td>
                   
                   <a   class="btn btn-info btn-block" target="_blank"  alt="View" title="View" href="{{ URL::to('/executor/viewinvoice', array('order_id' => $inv->Id)) }}"><i class="fa fa-eye"></i>View</a>
                   <?php
                    if(($inv->Status =='1')||($inv->Status =='0')) {?>
       <a class=" btn btn-primary btn-block viewinvoice" data-toggle="modal" alt="Edit" title="Edit"  id="event_<?php echo $inv->Id ?>" data-target="#ViewinvoiceModal">  <i class="fa fa-pencil"></i>Edit</a>
         <?php
                }
          ?>
                    
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
                                                                <thead >
                                                                    <tr>
                                                                        <th>S.no</th>
                                                                        <th>Event Name</th>
                                                                        <th>City</th>
                                                                        <th>Country</th>
                                                                        <th>Date</th>
                                                                        
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($categories as $cate)
                                                                  <tr>
                                                                  
                                                                  <td>{{$cate->id}}</td>
                                                                  <td>{{$cate->event}}</td>
                                                                  <td>{{$cate->city}}</td>
                                                                  <td>{{$cate->country}}</td>
                                                                  <td>{{$cate->date}}</td>
                                                                             <td class="center">

                                                                              <?php 
                                                                              $date2= strtotime(date('d-m-Y')); 
                                                                              $date1=strtotime($cate->date);
                                                                           if($date1 > $date2){
                                                                              ?>
                                                                               
                <a class="btn btn-info btn-block event" data-toggle="modal"  data-target="#eventModal" id="event_<?php echo $cate->id ?>"  href="">
                <i class="fa fa-pencil"></i>
                Edit
            </a>
            <?php
          }
          ?>
          <?php 
          foreach($invoice as $inv){
          $event1=$inv['Eventcode'];
        }
        ?>
           <?php
           if($event1 != $cate->eventcode){
            
             ?>
          <a class="btn btn-danger btn-block DelEve" href="#" data-toggle="modal"  id="event_<?php echo $cate->id ?>" data-target="#DelEventModal">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
          <?php

          }
          ?>
           
            
         
                                                                            </td>
                                                                  
                                                                </tr>
                                                                @endforeach


                                                                </tbody>
                                                                  <script type="text/javascript">


$('.event').click(function(e) {
 
   var eventid , evn,eventname,city,country,date;
   eventid =$(this).attr('id');
   evn =eventid.split('_');
   eventid=evn[1];
   //alert(eventid);

  eventname = $(this).closest("tr").find('td:eq(1)').text();
  city = $(this).closest("tr").find('td:eq(2)').text();
  country = $(this).closest("tr").find('td:eq(3)').text();
  date = $(this).closest("tr").find('td:eq(4)').text();
  
   
  
    $("#eventModal #eventId").val( eventid );
    $("#eventModal #eventName").val( eventname );
    $("#eventModal #eventCity").val( city );
    $("#eventModal #eventCountry").val( country );
    $("#eventModal #eventDate").val(date);

 
  
});
</script>
<script type="text/javascript">
 $('.DelEve').click(function(e) {
 
   var delid , del;
   delid =$(this).attr('id');
   del =delid.split('_');
   del1=del[1];
   // alert(del1);
   
    $("#DelEventModal #delEvent").val( del1 );
    
});
 $('.viewinvoice').click(function(e) {
 
   var delid , del;
   delid =$(this).attr('id');
   del =delid.split('_');
   del1=del[1];
   // alert(del1);
   
    $("#ViewinvoiceModal #viewinvoice").val( del1 );
    
});
</script>
 



                                                            </table>
                                                          </div>
            </div>
          </div>
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>

              <div class="modal bounceIn animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                      <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Employee</h3>
                        </div>
                        <form action="{{ url('/executor/updateemployee') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="emp_id_d" id="bookId"  value=""/>
                              <tr><td>Name</td><td>  <input type="text" class="form-control" name="emp_name" id="bookName" value=""/></td></tr>
                              <tr><td>Id</td><td><input type="text" class="form-control" name="emp_id" id="bookemp_id" value=""/></td></tr>
                              <tr><td>Department</td><td><input type="text" class="form-control" name="emp_dept" id="bookDept" value=""/></td></tr>
                             <tr><td>Employee Staus</td><td><select class="select2"  style="width:100%"  name="emp_status" data-placeholder="Choose One">
                              <option value=""> --select--</option>
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

            <div class="modal bounceIn animated" id="ViewinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Invoice Status</h3>
                        </div>
                        <form action="{{ url('/executor/updateinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                             <table width="100%"  class="table">
                                 <input type="hidden" name="view_invoice" id="viewinvoice"  value=""/>
                                 <select class="select2" style="width:100%"name="invoice_status">
                                   <option value="">--Select--</option>
                                   <option value="Attended with Modification">Attended with Modification</option>
                                   <option value="Attended without modification">Attended without modification</option>
                                   <option value="Not Attended">Not Attended</option>
                                   <option value="Entitlement">Entitlement</option>
                                     <option value="Deal Cancel">Deal Cancel</option>
                                 </select>
                             
                             </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>

               <div class="modal bounceIn animated" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Event</h3>
                        </div>
                        <form action="{{ url('/executor/eventupdate') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          <table width="100%"  class="table">
                           <input type="hidden" name="even_id" id="eventId"  value=""/>
                            <tr><td>Event Name</td><td> <input class="form-control" type="text" name="eventname" id="eventName" value=""/></td></tr>
                            <tr><td>City</td><td><input class="form-control" type="text" name="eventcity" id="eventCity" value=""/></td></tr>
                            <tr><td>Country</td><td> <input class="form-control" type="text" name="eventcountry" id="eventCountry" value=""/></td></tr>
                            <tr><td>Date</td><td><input class="form-control dob" type="text" name="eventdate" id="eventDate" value=""/></td></tr>
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

              <div class="modal bounceIn animated" id="DelEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Delete Employee</h3>
                        </div>
                        <form action="{{ url('/executor/delevent') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          <p>Do you really want to delete ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="evn_del_id" id="delEvent"  value=""/>
                             
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