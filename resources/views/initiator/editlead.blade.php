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
            <?php if(Auth::User()->role=='sales'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('initiator/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
                <li class="nav-parent active">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li class="active"><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                 <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs</span></a></li>
                <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>

              </ul>
            </li>
            <li class="nav-parent ">
              <a href=""><i class="fa fa-pencil-square-o"></i><span> Update New Deal</span></a>
             
             <ul class="children">
                <li><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>
            
              </ul>
            </li>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Edit Lead Sheet</strong></a></li>
           
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
                <form action="{{ url('/initiator/updateleadsheet') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      
                                      @foreach($lead_id as $leadedit)
                                      <input type="hidden" name="leadid" value="{{$leadedit->id}}">
                                          <div class="form-group">
                                        <label class="col-md-3 control-label"> Company Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" value="{{$leadedit->company_name}}"  name="company_name">
                                        </div>
                                         <label class="col-md-2 control-label"> Website </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" value="{{$leadedit->website}}"  name="website">
                                        </div>
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-3 control-label"> Country</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" value="{{$leadedit->country}}"  name="country">
                                        </div>
                                         <label class="col-md-2 control-label"> Other Office </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" value="{{$leadedit->otheroffice}}"  name="office_number">
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-3 control-label"> Product Category</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" value="{{$leadedit->product_category}}"  name="product_category">
                                        </div>
                                         <label class="col-md-2 control-label">Product Sub Category</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" value="{{$leadedit->product_sub_category}}"  name="product_sub_category">
                                        </div>
                                        </div>
                                       
                                        
                                         <div class="form-group">
                                        <label class="col-md-3 control-label">  Phone</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->phone}}" autocomplete="off" name="phone">
                                        </div>
                                         <label class="col-md-2 control-label">Fax </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="{{$leadedit->fax}}" autocomplete="off" name="fax">
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-3 control-label">  Partnership Package Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="{{$leadedit->partnership_package_name}}" autocomplete="off" name="pname">
                                        </div>
                                         <label class="col-md-2 control-label">  Partnership Package Value </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control "  value="{{$leadedit->partnership_package_value}}" autocomplete="off" name="pvalue">
                                        </div>
                                        </div>
                                      <center><h4><u>DECISION MAKER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->dmname}}" autocomplete="off" name="dmname">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->dmdesignation}}"  autocomplete="off" name="dmdesignation">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="{{$leadedit->dmphone}}" autocomplete="off" name="dmphone">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->dmmobile}}" autocomplete="off" name="dmmobile">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->dmemail}}" autocomplete="off" name="dmemail">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->dmaltnumber}}" autocomplete="off" name="dmaltnumber">
                                        </div>
                                        </div>
                                        <center><h4><u>INFLUENCER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infname}}" autocomplete="off" name="infname">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infdesignation}}" autocomplete="off" name="infdesignation">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label">  Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infphone}}" autocomplete="off" name="infphone">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infmobile}}" autocomplete="off" name="infmobile">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infemail}}" autocomplete="off" name="infemail">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->infaltnumber}}" autocomplete="off" name="infaltnumber">
                                        </div>
                                        </div>
                                         <center><h4><u>SPECIFIER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->specname}}" autocomplete="off" name="specname">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->specdesignation}}" autocomplete="off" name="specdesignation">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label">  Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="{{$leadedit->specphone}}" autocomplete="off" name="specphone">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->spemobile}}"  autocomplete="off" name="spemobile">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="{{$leadedit->speemail}}" autocomplete="off" name="speemail">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " value="{{$leadedit->spealtnumber}}" autocomplete="off" name="spealtnumber">
                                        </div>
                                        </div>
                                    
                                      <div class="form-group">
                                        <label class="col-md-3 control-label"> Remarks</label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" rows="10" name="remarks">{{$leadedit->remarks}}</textarea>
                                        </div>
                                         <label class="col-md-2 control-label">  Competitors </label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" rows="10" name="competitors">{{$leadedit->competitors}}</textarea>
                                        </div>
                                        </div>
                                          @endforeach
                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Save</button>
                                        </div>
                                        </div>
                                
                                      
</form>
            </div>
            <div class="tab-pane" id="recent5">
       
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
