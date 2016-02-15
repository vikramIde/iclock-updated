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
                <li ><a  href="{{ URL::to('executor/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent ">
              <a  href=""><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
             <ul class="children">
                <li ><a  href="{{URL::to('executor/dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a></li>
            
              </ul>
            </li>
             <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Reset Password</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('resetpass') }}" ><i class="fa fa-undo"></i><span> Reset Password</span></a></li>
            
              </ul>
            </li>
            <?php } ?>
            <?php if(Auth::User()->role=='admin2'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('reviewer/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
             <li class="nav-parent active">
              <a href=""><i class="fa fa-undo"></i><span> Reset Password</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('resetpass') }}" ><i class="fa fa-undo"></i><span> Reset Password</span></a></li>
            
              </ul>
            </li>
            <?php } ?>
            <?php if(Auth::User()->role=='sales'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/home')}}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Update New Deal</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/updateeventdeal')}}" ><i class="fa fa-pencil-square-o"></i><span> Update New Deal</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Variance Card</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/variancecard')}}" ><i class="fa fa-line-chart"></i><span> Variance Card</span></a></li>
            
              </ul>
            </li>
            
             <li class="nav-parent active">
              <a href=""><i class="fa fa-home"></i><span> Reset Password</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('resetpass') }}" ><i class="fa fa-undo"></i><span> Reset Password</span></a></li>
            
              </ul>
            </li>
            <?php } ?>
            <?php if(Auth::User()->role=='collector'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('collection/home')}}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
             <li class="nav-parent active">
              <a href=""><i class="fa fa-undo"></i><span> Reset Password</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('resetpass') }}" ><i class="fa fa-undo"></i><span> Reset Password</span></a></li>
            
              </ul>
            </li>
            <?php } ?>
            <?php if(Auth::User()->role=='director'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li><a  href="{{ URL::to('approval/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            
            <li class="nav-parent">
              <a  href=""><i class="fa fa-thumbs-o-up"></i><span>Assign Target</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('approval/assigntarget')}}"><i class="fa fa-thumbs-o-up"></i><span> Assign Target</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent">
              <a  href=""><i class="fa fa-thumbs-o-up"></i><span>Add User</span></a>
             <ul class="children">
                <li><a  href="{{URL::to('approval/adduser')}}"><i class="fa fa-thumbs-o-up"></i><span> Add User</span></a></li>
            
              </ul>
            </li>
            
             <li class="nav-parent active">
              <a href=""><i class="fa fa-undo"></i><span> Reset Password</span></a>
             
             <ul class="children">
                <li class="active"><a  href="{{ URL::to('resetpass') }}" ><i class="fa fa-undo"></i><span> Reset Password</span></a></li>
            
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
        <li class="active">Reset Password</li>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Reset Password</strong></a></li>
          
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">

              <form class="form-horizontal" role="form" method="POST" action="{{ url('/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            

            
                <input type="hidden" class="form-control" autocomplete="off" name="userid" value="{{ Auth::user()->id }}" >
                <div class="form-group">
              <label class="col-md-4 control-label">Current Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" autocomplete="off" name="currentpassword" >
              </div>
            </div>
            

            <div class="form-group">
              <label class="col-md-4 control-label">New Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" autocomplete="off" name="npassword" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Confirm New Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control"  autocomplete="off"name="password_confirmation" >
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Reset Password
                </button>
              </div>
            </div>
          </form>                           


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
 
$('.dob').datepicker();
  $('#datepicker-inline').datepicker();
  $('#datepicker-multiple').datepicker({ numberOfMonths: 2 });
});
</script>

@endsection
