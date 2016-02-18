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
              <div class="table-responsive">
                <form action="" method="post">
                <h3>Deleagte  Information</h3>
                 <div class="row">
                    @foreach($vip as $v)
                  <div class="col-md-6">
                    <h4>Delegate 1</h4>
              
               

         <table class="table">
          <tr>
            <th>Name</th><th><input type="text" name="pname"  value="{{$v->pname}}" class="form-control"></th>

          </tr>
           <tr>
            <th>Name on Badge</th><th><input type="text" name="pnameonbadge"  value="{{$v->pnameonbadge}}" class="form-control"></th>
            
          </tr>
           <tr>
            <th>Passport</th><th><input type="text" name="ppassport"  value="{{$v->ppassport}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Email</th><th><input type="text" name="pemail"  value="{{$v->pemail}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Mobile</th><th><input type="text" name="pmobile"  value="{{$v->pmobile}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Designation</th><th><input type="text" name="pdesg"  value="{{$v->pdesg}}" class="form-control"></th>
            
          </tr>
         

        </table>
        
        </div>
        <div class="col-md-6">
           <h4>Delegate 2</h4>
              
               

         <table class="table">
          <tr>
            <th> Name</th><th><input type="text" name="sname"  value="{{$v->sname}}" class="form-control"></th>

          </tr>
           <tr>
            <th>Name on Badge</th><th><input type="text" name="snameonbadge"  value="{{$v->snameonbadge}}" class="form-control"></th>
            
          </tr>
           <tr>
            <th>Passport</th><th><input type="text" name="spassport"  value="{{$v->spassport}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Email</th><th><input type="text" name="semail"  value="{{$v->semail}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Mobile</th><th><input type="text" name="smobile"  value="{{$v->smobile}}" class="form-control"></th>
            
          </tr>
            <tr>
            <th>Designation</th><th><input type="text" name="sdesg"  value="{{$v->sdesg}}" class="form-control"></th>
            
          </tr>
         

        </table>
        </div>
            <div class="col-md-6">
           <h4>Benefits</h4>
              
               
@foreach($benefits as $ben)
         <table class="table">
          <tr>
            <th> Hotel Accomdation</th><th>
            <input type="radio" name="hotelaccommodation" value="1"  <?php if($ben->hotelaccommodation== "1") { echo 'checked="checked"'; } ?> > YES
             <input type="radio" name="hotelaccommodation" value="0"  <?php if($ben->hotelaccommodation== "0") { echo 'checked="checked"'; } ?>>NO
</th>

          </tr>
           <tr>
            <th>specification</th><th>
             <input type="radio" name="specification" value="Single Occupancy"  <?php if($ben->specification== "Single Occupancy") { echo 'checked="checked"'; } ?> > Single Occupancy
             <input type="radio" name="specification" value="Double Occupancy"  <?php if($ben->specification== "Double Occupancy") { echo 'checked="checked"'; } ?>>Double Occupancy
             <input type="radio" name="specification" value="Single & Double Occupancy"  <?php if($ben->specification== "Single & Double Occupancy") { echo 'checked="checked"'; } ?>>Single & Double Occupancy

            
          </tr>
           <tr>
            <th>Flight Ticket</th><th>    <input type="radio" name="flightticket" value="1"  <?php if($ben->flightticket== "1") { echo 'checked="checked"'; } ?> > YES
             <input type="radio" name="flightticket" value="0"  <?php if($ben->flightticket== "0") { echo 'checked="checked"'; } ?>>NO

          </tr>
            <tr>
            <th>Airport P/D</th><th>
            <input type="radio" name="airportpickupdrop" value="1"  <?php if($ben->airportpickupdrop== "1") { echo 'checked="checked"'; } ?> > YES
             <input type="radio" name="airportpickupdrop" value="0"  <?php if($ben->airportpickupdrop== "0") { echo 'checked="checked"'; } ?>>NO
         
          </tr>
            <tr>
            <th>VISA</th><th>
                 <input type="radio" name="visa" value="1"  <?php if($ben->visa== "1") { echo 'checked="checked"'; } ?> > YES
             <input type="radio" name="visa" value="0"  <?php if($ben->visa== "0") { echo 'checked="checked"'; } ?>>NO
         
   
            
          </tr>
   

        </table>
        @endforeach
        </div>
          @endforeach
      </div>
      <center>
            <input type="submit" name="submit" value="Save"  class="btn btn-primary">
      </center>
  
    </form>
                   </div>
            </div>
          


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