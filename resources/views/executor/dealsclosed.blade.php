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
          <?php if(Auth::User()->role=='admin1'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('executor/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent active">
              <a  href=""><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
             <ul class="children">
                <li class="active"><a  href="{{URL::to('executor/dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a></li>
            
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
        <li class="active">DealsClosed</li>
      </ol>

     

      <div class="row">

             <div class="col-md-12">

         
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Create Invoice</strong></a></li>
            <li><a href="#comments5" data-toggle="tab"><strong>Deal Cancelled</strong></a></li>
       
       
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">

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
                                  <th>Actions</th>


                          </tr>
                        </thead>
                        <tbody>
                                  @foreach($categories as $val)
                                  <tr>
                                  <td>{{$val->Companyname}}</td>
                                  <td>{{$val->Eventname}}</td>
                                  <td>{{$val->Dealdate}}</td>
                                  <td style="text-align:right">{{$val->Dealvalue}}</td>
                                  <td>{{$val->Dealcurr}}</td>
                                  <td>{{$val->Dealtype}}</td>
                                  <td>{{$val->Empid}} - {{$val->Empname}}</td>
                                  <td>
                                    <a href="{{ URL::to('executor/createinvoice', array('dealid' => $val->Id)) }}" class="btn btn-info btn-block"> <i class="fa fa-plus"></i> Create Invoice</a>
                                    <a class=" btn btn-danger btn-block viewinvoice" data-toggle="modal"  id="event_<?php echo $val->Id ?>" data-target="#ViewinvoiceModal">  
                                      <i class="fa fa-trash"></i> Reject Deal</a>

                                  </td>
                                  </tr>
                                  @endforeach
                        </tbody>
                       </table>
            </div>
                                                    


            </div>
   
          <script type="text/javascript">
           $('.viewinvoice').click(function(e) {
 
   var delid , del;
   delid =$(this).attr('id');
   del =delid.split('_');
   del1=del[1];
   // alert(del1);
   
    $("#ViewinvoiceModal #viewinvoice").val( del1 );
    
});
</script>
              <div class="tab-pane" id="comments5">
              <div class="table-responsive">
                        <table id="dataTable2" class="table table-bordered table-striped-col">
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

            <div class="modal bounceIn animated" id="ViewinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Deal Status</h3>
                        </div>
                        <form action="{{ url('/executor/dealcancel') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                            <p>are you want to cancel the deal ?</p>
                              <input type="text" name="dealid" id="viewinvoice"  value=""/>
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
 
$('.dob').datepicker();
  $('#datepicker-inline').datepicker();
  $('#datepicker-multiple').datepicker({ numberOfMonths: 2 });
});
</script>

@endsection
