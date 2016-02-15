@extends('app')

@section('content')
<!-- <script type='text/javascript' src="{{asset('js/jquery-1.11.2.min.js')}}"></script> -->
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
              <a href="{{ URL::to('initiator/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a>
             <ul class="children">
                <li  class="active"><a  href="{{ URL::to('initiator/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
             <li class="nav-parent active">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li ><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                  <li ><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li ><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs </span></a></li>
                  <li><a href="{{ URL::to('initiator/dealclose')}}"><i class="fa fa-line-chart"></i><span> Pending for  Deal Closed</span></a></li>
                   <li class="active"><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>
              
              </ul>
            </li>
              
          <li class="nav-parent ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>
             
             <ul class="children">
                <li><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
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
        
            <?php } } ?>
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
           
            <li class="active"><a href="#recent5" data-toggle="tab"><strong>Blowout Leads <span style="color:red">( <?php echo count($blowout); ?>  )</span></strong></a></li>
          
           
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">


            <div class="tab-pane active" id="recent5">
                            <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr >
                                                                      <th>Lead Id</th>
                                                                      <th>Company Name</th>
                                                                      <th>Product Category</th>
                                                                      <th>Phone</th>
                                                                     
                                                                      <th>Partnership Package Name</th>
                                                                      <th>Partnership Package Value</th>
                                                                      <th>Actions</th>
                                                                    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($blowout as $lead)
                                                                  <tr>
                                                                    <td>{{$lead->leadcode}}</td>
                                                                 <td>{{$lead->company_name}}</td>
                                                                 <td>{{$lead->product_category}}</td>
                                                                 <td>{{$lead->phone}}</td>
                                                                 
                                                                 <td>{{$lead->partnership_package_name}}</td>
                                                                 <td>{{$lead->partnership_package_value}}</td>
                                                                 <td>
                                                                  
                                                               <!--    <a  href="{{ URL::to('/initiator/editlead', array('leadid' => $lead->id)) }}"><i class="fa fa-pencil">Edit</i></a>&nbsp;&nbsp;
                                                                  <a  href="{{ URL::to('/initiator/callbacksheet', array('leadid' => $lead->id)) }}"><i class="fa fa-pencil">Pitch</i></a>&nbsp;&nbsp; -->
                                  <a class="btn btn-primary employee btn-block" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $lead->id ?>">Re Activate</a>
                                                                 </td>

                                                                  </tr>
                                                                  @endforeach
                                                                </tbody>
                                                            </table>
                                                          </div>
            </div>
               <div class="tab-pane active" id="recent6">
               </div>
            
              
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>
<script type="text/javascript">


$('.employee').click(function(e) {
 
   var actoinid , nId,name,employe_id,department,empid;
   actoinid =$(this).attr('id');
   nId =actoinid.split('_');
   empid=nId[1];

    $("#myModal #bookId").val( empid );
   
});
  

</script>
     <div class="modal bounceIn animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                      <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Reactivate deal </h3>
                        </div>
                        <form action="{{ url('/initiator/reactivatedeal') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="leadid" id="bookId"  value=""/>
                              
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
