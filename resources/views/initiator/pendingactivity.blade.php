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
        <li class="active">My Leads</li>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>My Deals</strong></a></li>
            <!-- <li><a href="#recent5" data-toggle="tab"><strong>MY Score Card</strong></a></li> -->
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
                @foreach($emp as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
                                       <input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
                                      @endforeach

                        <div class="table-responsive">
               <table  id="dataTable2" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>
                                                                      <th>Company Name</th>
                                                                      <th>Event Name</th>
                                                                      <th>Deal Closed Date</th>
                                                                      <th>Deal Value</th>
                                                                      <th>Currency</th>
                                                                        <th>BOQ</th>
                                                                          <th> VIP</th>
                                                                            <th>logo</th>
                                                                            <th>hotel</th>
                                                                            <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($deals as $data)
                                                                  <tr>
                                                                  <td>{{$data->Companyname}}</td>
                                                                  <td>{{$data->Eventname}}</td>
                                                                  <td >{{$data->Dealdate}}</td>
                                                                  <td style="text-align:right">{{$data->Dealvalue}}</td>
                                                                  <td>{{$data->Dealcurr}}</td>
                                                                     @foreach($dealinfo as $info)
                                                                     <?php 
                                                                     if($info->boq=='1'){
                                                                     ?>
                                                                     <th>Accepted</th>
                                                                     
                                                                     <?php
                                                                     }
                                                                     ?>
                                                                     <?php 
                                                                     if($info->vip=='NULL'){
                                                                     ?>
                                                                     <th>Pending</th>
                                                                     
                                                                     <?php
                                                                     }if($info->vip=='1'){
                                                                     ?>
                                                                     <th>Accepted</th>
                                                                     <?php
                                                                     }if($info->vip=='0'){
                                                                     ?>
                                                                     <th>Rejected</th>
                                                                     <?php
                                                                     }?>
                                                                       <?php 
                                                                     if($info->logo=='NULL'){
                                                                     ?>
                                                                     <th>Pending</th>
                                                                     
                                                                     <?php
                                                                     }else{
                                                                     ?>
                                                                     <th>{{$info->logo}}</th>
                                                                     <?php
                                                                     }
                                                                     ?>
                                                                     
                                                                       <?php 
                                                                     if($info->hotel=='NULL'){
                                                                     ?>
                                                                     <th>Pending</th>
                                                                     
                                                                     <?php
                                                                     }if($info->hotel=='1'){
                                                                     ?>
                                                                     <th>Accepted</th>
                                                                     <?php
                                                                     }if($info->hotel=='0'){
                                                                     ?>
                                                                     <th>Rejected</th>
                                                                     <?php
                                                                     }?>
                                                                    @endforeach 
                                                                         
                                                                            <th>   
                                                                    <a  href="{{ URL::to('/initiator/editdeal', array('dealid' => $data->leadcode)) }}"class="btn btn-primary employee btn-block">Update</a>
                                                              </th>
                                                                  </tr>
                                                                  @endforeach                                        
                                                             </tbody>
                                                            </table>
                                                          </div>


      
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
 

});
</script>

@endsection
