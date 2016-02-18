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
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('reviewer/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
              <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Hotel & Travel</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('reviewer/pendingactivity') }}" ><i class="fa fa-home"></i><span> Pending Activity</span></a></li>
            
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

     
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Delegates Information</strong></a></li>
        
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
           
              
            
                 <div class="row">
                    @foreach($vip as $v)
                  <div class="col-md-12">
                                    <form action="{ url('/reviewer/hotelform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                     
                  
                                      <div class="form-group">
                                          <label class="col-md-4">Primary Delagate Email</label>
                                        <div class="col-md-4 ">{{$v->pemail}}</div>
                                       
                                        </div>
                                      <div class="form-group">
                                                 <label class="col-md-4 ">Alternate Email Address</label>
                                        <div class="col-md-4 "><input type="email" name="altemail" class="form-control" autocomplete="off" ></div>
                                       
                                        </div>

                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Send Link</button>
                                        </div>
                                        </div>
                                
                                      
</form>
   

                   </div>
                   @endforeach
            


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