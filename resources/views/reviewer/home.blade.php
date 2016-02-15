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
            <?php if(Auth::User()->role=='admin2'){ ?>      
            <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('reviewer/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
        
            <?php } ?>
          </ul>
        </div><!-- tab-pane -->

    

      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">
@foreach($edetails as $en)

<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
@endforeach
    <div class="contentpanel">
      @if (count($errors) > 0)
      <script>
$(function() {
    $('#rejectModal').modal('show');
});
</script>
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
        <li class="active">Page1</li>
      </ol>

     

      <div class="row">

             <div class="col-md-12">

         <?php
         if($en->emp_ide_id=='IDE013'){
          ?>
  
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Current list of Invoices</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>All Invoices</strong></a></li>
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
              <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr >
                                                                        <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Deal Value</th>
                                                                        <th>Deal Currency</th>
                                                                        <th>Rc Value</th>
                                                                        <th>Status</th>
                                                                    
                                                                        <th>Action</th>
                                                                                                
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($invnull as $invn)
                                                                  <tr>
                                                                  
                                                                  <td>{{$invn->Id}}</td>
                                                                  <td>{{$invn->Companyname}}</td>
                                                                  <td>{{$invn->EventName}}</td>
                                                                  <td>{{$invn->RepresentativeNo}}-{{$invn->Repname}}</td>
                                                                  <td style="text-align:right">{{$invn->Amount}}</td>
                                                                   <td >{{$invn->CurrencyType}}</td>
                                                                   <td style="text-align:right">{{$invn->Rcvalue}}</td>
                                                              
                                                                  <td class="center">
            <?php
                                                      if($invn->Status == 'NULL')  {?>
                                                        <span class="label-warning label label-default">Pending</span>
                                                        <?php
                                                    }
                                                    ?>
           
        </td>
                                                                 <td class="center">
           <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('/reviewer/viewinvoice', array('order_id' => $invn->Id)) }}">
                   <i class="fa fa-eye"></i>
                View
            </a>
            <?php
             if($invn->Status  =='NULL') {?>
            
             <a class="btn btn-success btn-block invoiceapprove" href="" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $invn->Id ?>">
                <i class="glyphicon glyphicon-thumbs-up icon-white"></i>
                Approve
            </a>
             <a class="btn btn-danger btn-block invoicereject" href="" data-toggle="modal"  data-target="#rejectModal" id="action_<?php echo $invn->Id ?>">
                <i class="glyphicon glyphicon-thumbs-down icon-white"></i>
              Reject
            </a>

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
            <div class="tab-pane" id="recent5">
              <div class="table-responsive">
               <table  id="dataTable2" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>

                                                                        <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Deal Value</th>
                                                                        <th>Deal Currency</th>
                                                                        <th>Rc Value</th>
                                                                        <th>Status</th>
                                                                    
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
                                                                  <td class="center" >
            <?php
                                                        if($inv->Status =='1') {?>
                                              <span class="label-success label label-default">Approved</span>
                                                            <?php
                                                        } if($inv->Status == '0'){?>
                                             <span class="label-default label label-danger">Rejected</span>
                                                           <?php
                                                        }if($inv->Status == 'NULL')  {?>
                                                        <span class="label-warning label label-default">Pending</span>
                                                        <?php
                                                    }
                                                    ?>
           
        </td>
         <td class="center">
           <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('/reviewer/viewinvoice', array('order_id' => $inv->Id)) }}">
                   <i class="fa fa-eye"></i>
                View
            </a>
            <?php
             if($inv->Status  =='NULL') {?>
            
             <a class="btn btn-success btn-block invoiceapprove" href="" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $inv->Id ?>">
                <i class="glyphicon glyphicon-thumbs-up icon-white"></i>
                Approve
            </a>
             <a class="btn btn-danger btn-block invoicereject" href="" data-toggle="modal"  data-target="#rejectModal" id="action_<?php echo $inv->Id ?>">
                <i class="glyphicon glyphicon-thumbs-down icon-white"></i>
              Reject
            </a>

             <?php
         }
            ?>
             <?php
             if($inv->Status  =='1') {?>
            <a class="btn btn-success btn-block"  >
                <i class="glyphicon glyphicon-thumbs-up icon-white"></i>
                Approved
            </a>
           
<?php
            }
            ?>
              <?php
               if($inv->Status  =='0') {?>
            <a class="btn btn-danger btn-block" href="">
                <i class="glyphicon glyphicon-thumbs-down icon-white"></i>
              Rejected
            </a>
             
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
            
              
        </div><!-- col-md-6 -->

        <?php
      }else {
      ?>
      <ul class="nav nav-tabs nav-primary">
         
            <li class="active"><a href="#recent5" data-toggle="tab"><strong>All Invoices</strong></a></li>
            
          </ul>
  <div class="tab-content mb20">
 
            <div class="tab-pane active" id="recent5">
              <div class="table-responsive">
               <table  id="dataTable2" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr>

                                                                        <th>S.no</th>
                                                                        <th>Company Name</th>
                                                                        <th>Event Name</th>
                                                                        <th>Sales Rep</th>
                                                                        <th>Deal Value</th>
                                                                        <th>Deal Currency</th>
                                                                        <th>Rc Value</th>
                                                                        <th>Status</th>
                                                                    
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
                                                                  <td class="center" >
            <?php
                                                        if($inv->Status =='1') {?>
                                              <span class="label-success label label-default">Approved</span>
                                                            <?php
                                                        } if($inv->Status == '0'){?>
                                             <span class="label-default label label-danger">Rejected</span>
                                                           <?php
                                                        }if($inv->Status == 'Null')  {?>
                                                        <span class="label-warning label label-default">Pending</span>
                                                        <?php
                                                    }
                                                    ?>
           
        </td>
         <td class="center">
           <a class="btn btn-info btn-block" target="_blank" href="{{ URL::to('/reviewer/viewinvoice', array('order_id' => $inv->Id)) }}">
                   <i class="fa fa-eye"></i>
                View
            </a>
           
        </td>
                                                                </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                          </div>
                       
            </div>
            
              
        </div><!-- col-md-6 -->
        <?php
      }
      ?>
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
                <form action="{{ url('/reviewer/approveinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to approve ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="invoice_approve_id" id="eventDel"  value=""/>
                                  <input type="hidden" name="approve_status" value="1"/>
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


    <div class="modal bounceIn animated" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Reject</h3>
                </div>
                <form action="{{ url('/reviewer/rejectinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to Reject ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="invoice_reject_id" id="invoiceRej"  value=""/>
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
 
   var approveid , approve;
   approveid =$(this).attr('id');
   approve =approveid.split('_');
   approveid=approve[1];
   
    $("#myModal #eventDel").val( approveid );
    
});
  

</script>
<script type="text/javascript">


$('.invoicereject').click(function(e) {
 
   var rejectid , reject;
   rejectid =$(this).attr('id');
   reject =rejectid.split('_');
   rejectid=reject[1];
   
    $("#rejectModal #invoiceRej").val( rejectid );
    
});
  

</script>
<script>

$(document).ready(function() {

  'use strict';

    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
 

});
</script>

@endsection