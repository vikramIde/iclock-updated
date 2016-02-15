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
            <?php if(Auth::User()->role=='collector'){ ?>      
            <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a class="ajax-link" href="{{ URL::to('collection/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Approved Today's Due Invoices</strong> <span style="color:red">( <?php echo count($duetoday) ?> )</span></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>Approved Due Invoices</strong> <span style="color:red">( <?php echo count($invoices) ?> )</span></a></li>
			<li><a href="#recent6" data-toggle="tab"><strong>Today's Over Due</strong> <span style="color:red">( <?php echo count($overduetoday) ?> )</span></a></li>
			<!--<li><a href="#recent5" data-toggle="tab"><strong>Total Over Due</strong></a></li>--->
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
             <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>
																		<th>S.no</th>
																		<th>Company Name</th>
																		<th>Event Name</th>
																		<th>Sales Rep</th>
																		<th>Invoice Value</th>
																		<th>Invoice Currency</th>
																		<th>RC Value</th>
																		<th>Due Date</th>
																		<th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                               @foreach($duetoday as $inv)
                                                  <?php if($inv->DueDate == date("Y-m-d")) {?>
                                                  <tr>
                                                  <td>{{$inv->Id}}</td>
                                                  <td>{{$inv->Companyname}}</td>
                                                  <td>{{$inv->EventName}}</td>
                                                  <td>{{$inv->RepresentativeNo}}</td>
                                                  <td style="text-align:right">{{$inv->GrandTotal}}</td>
                                                  <td>{{$inv->CurrencyType}}</td>
                                                  <td style="text-align:right">{{$inv->Rcvalue}}</td>
                                                  <td>{{$inv->DueDate }} </td>
                                                       <td class="center">
                                                                    <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('collection/viewinvoice', array('order_id' => $inv->Id)) }}">
                                                                         <i class="fa fa-eye"></i>
                                                                        View
                                                                            </a> <?php  if($inv->Status =='1') {?>
                                                                    <a href="{{ URL::to('collection/payment', array('order_id' => $inv->Id)) }}"  class="btn btn-primary btn-block "   id="<?php echo $inv->Id ?>" >
                                                                      <i class="fa fa-money"></i> 
                                                                            Recieve
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                      ?> </td>
                                                </tr>
                                                <?php } ?>
                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                          </div>
            </div>
            <div class="tab-pane" id="recent5">
			 <div class="table-responsive">
               <table  id="dataTable2" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>
                                                                          <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Invoice  Value</th>
                                                                        <th>Invoice Currency</th>
                                                                         <th>RC Value</th>
                                                                        <th >Due Date</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($invoices as $inv)
                                                                   
                                                                  <tr>
                                                                  
                                                                  <td>{{$inv->Id}}</td>
                                                                  <td style="width:200px">{{$inv->Companyname}}</td>
                                                                  <td style="width:170px">{{$inv->EventName}}</td>
                                                                  <td>{{$inv->RepresentativeNo}}</td>
                                                                  <td style="text-align:right">{{$inv->Amount}}</td>
                                                                  <td  style="width:50px">{{$inv->CurrencyType}}</td>
                                                                  <td  style="text-align:right">{{$inv->Rcvalue}}</td>
                                                                  <td>{{$inv->DueDate }} </td>
                                                                  <td class="center">
                                                                    <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('collection/viewinvoice', array('order_id' => $inv->Id)) }}">
                                                                        <i class="fa fa-eye"></i>
                                                                        View
                                                                            </a> <?php  if($inv->Status =='1') {?>
                                                                    <a href="{{ URL::to('collection/payment', array('order_id' => $inv->Id)) }}"  class="btn btn-primary btn-block "   id="<?php echo $inv->Id ?>" >
                                                                    <i class="fa fa-money"></i>&nbsp;
                                                                            Receive
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                      ?> </td>
                                                                </tr>
                                                               
                                                                @endforeach                                                     </tbody>
                                                            </table>
                                                          </div>
                       
            </div>
			
			<div class="tab-pane" id="recent6">
               <div class="table-responsive">
               <table  id="dataTable3" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>
                                                                         <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Invoice  Value</th>
                                                                        <th>Invoice Currency</th>
                                                                         <th>RC Value</th>
                                                                        <th >Due Date</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                               @foreach($overduetoday as $inv)
                                                  <?php if($inv->NxtDuedate == date("Y-m-d")) {?>
                                                  <tr>
                                                  <td>{{$inv->Id}}</td>
                                                  <td>{{$inv->Companyname}}</td>
                                                  <td>{{$inv->EventName}}</td>
                                                  <td>{{$inv->RepresentativeNo}}</td>
                                                  <td style="text-align:right">{{$inv->GrandTotal}}</td>
                                                  <td>{{$inv->CurrencyType}}</td>
                                                  <td style="text-align:right">{{$inv->Rcvalue}}</td>
                                                  <td>{{$inv->DueDate }} </td>
                                                       <td class="center">
                                                                    <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('collection/viewinvoice', array('order_id' => $inv->Id)) }}">
                                                                         <i class="fa fa-eye"></i>
                                                                        View
                                                                            </a> <?php  if($inv->Status =='1') {?>
                                                                    <a href="{{ URL::to('collection/payment', array('order_id' => $inv->Id)) }}"  class="btn btn-primary btn-block "   id="<?php echo $inv->Id ?>" >
                                                                      <i class="fa fa-money"></i> 
                                                                            Recieve
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                      ?> </td>
                                                </tr>
                                                <?php } ?>
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
	$('#dataTable3').DataTable();
 

});
</script>

@endsection
