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
            <?php if(Auth::User()->role=='marketing'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a  href="{{ URL::to('marketing/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
            <li class="nav-parent active">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li class="active"><a href="{{ URL::to('marketing/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                <li><a href="{{ URL::to('marketing/leadstatus')}}"><i class="fa fa-line-chart"></i><span>Lead Status</span></a></li>
                

              </ul>
            </li>
          
        
            <?php }  ?>
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Generate Lead Sheet</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>My Leads  <span style="color:red">( <?php echo count($leads) ?> )</span></strong></a></li>

          
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
                <form action="{{ url('/marketing/generateleadsheet') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                         @foreach($edetails as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
                                      <input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
                                      @endforeach
                                      <div class="row">
                                        <span style="color:red">All * mark fiedls are mandatory</span>
                                        <div class="col-md-12">
                                        </div>
                                          <div class="col-md-6">
                                        </div>
                                      </div>
                                       
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Company Name <span style="color:red">*</span></label>
                                        <div class="col-md-4">
                                            <input type="text" id='emp_id' class="form-control" autocomplete="off" name="company_name"  value="{{ old('company_name') }}" >
                                        </div>
                                         <label class="col-md-1 control-label">  Country <span style="color:red">*</span></label>
                                         <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="country" value="{{ old('country') }}">
                                        </div>
                                        
                                        </div>
                                           <div class="form-group">
                                        <label class="col-md-3 control-label"> Website <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="website" value="{{ old('website') }}">
                                        </div>
                                         <label class="col-md-2 control-label"> Other Office <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="office_number" value="{{ old('office_number') }}">
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-3 control-label"> Product Category <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="product_category" value="{{ old('product_category') }}">
                                        </div>
                                         <label class="col-md-2 control-label">Product Sub Category <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="product_sub_category" value="{{ old('product_sub_category') }}">
                                        </div>
                                        </div>
                                       
                                         <div class="form-group">
                                        <label class="col-md-3 control-label">  Board Line <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="boardline" value="{{ old('boardline') }}">
                                        </div>
                                         <label class="col-md-2 control-label"> Fax <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="fax" value="{{ old('fax') }}">
                                        </div>
                                        </div>
                                            <div class="form-group">
                                        <label class="col-md-3 control-label">  Partnership Package Name <span style="color:red">*</span></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="pname" value="{{ old('pname') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Partnership Package Value <span style="color:red">*</span> </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="pvalue" value="{{ old('pvalue') }}">
                                        </div>
                                        </div>
                                      <center><h4><u>DECISION MAKER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="dmname" value="{{ old('dmname') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="dmdesignation" value="{{ old('dmdesignation') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="dmphone" value="{{ old('dmphone') }}">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="dmmobile" value="{{ old('dmmobile') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="dmemail" value="{{ old('dmemail') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="dmaltnumber" value="{{ old('dmaltnumber') }}">
                                        </div>
                                        </div>
                                        <center><h4><u>INFLUENCER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infname" value="{{ old('infname') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infdesignation" value="{{ old('infdesignation') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infphone" value="{{ old('infphone') }}">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infmobile" value="{{ old('infmobile') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infemail" value="{{ old('infemail') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="infaltnumber" value="{{ old('infaltnumber') }}">
                                        </div>
                                        </div>
                                         <center><h4><u>SPECIFIER</u></h4></center>
                                       <div class="form-group">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="specname" value="{{ old('specname') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Designation </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="specdesignation" value="{{ old('specdesignation') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Direct Line</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="specphone" value="{{ old('specphone') }}">
                                        </div>
                                         <label class="col-md-2 control-label">Mobile </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="spemobile" value="{{ old('spemobile') }}">
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" autocomplete="off" name="speemail" value="{{ old('speemail') }}">
                                        </div>
                                         <label class="col-md-2 control-label">  Alternate Number </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control " autocomplete="off" name="spealtnumber" value="{{ old('spealtnumber') }}">
                                        </div>
                                        </div>
                                    
                                      <div class="form-group">
                                        <label class="col-md-3 control-label"> Remarks</label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" rows="10" name="remarks">{{ old('remarks') }}</textarea>
                                        </div>
                                         <label class="col-md-2 control-label">  Competitors </label>
                                        <div class="col-md-2">
                                            <textarea class="form-control" rows="10" name="competitors">{{ old('competitors') }}</textarea>
                                        </div>
                                        </div>
                                         <div class="form-group">
                                        <label class="col-md-6 control-label"> </label>
                                        <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary" name="submit">Save</button>
                                        </div>
                                        </div>
                                
                                      
</form>
            </div>
            <div class="tab-pane" id="recent5">
       
                       <div class="table-responsive">
             <table  id="dataTable1" class="table table-bordered table-striped-col">
                                                                <thead >
                                                                    <tr >
                                                                      <th>Lead ID</th>
                                                                      <th>Company Name</th>
                                                                      <th>Product Category</th>
                                                                      <th>Phone</th>
                                                                     
                                                                      <th>Partnership Package Name</th>
                                                                      <th>Partnership Package Value</th>
                                                                      <th>Actions</th>
                                                                    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($leads as $lead)
                                                                  <tr>
                                                                    <td>{{$lead->leadcode}}</td>
                                                                 <td>{{$lead->company_name}}</td>
                                                                 <td>{{$lead->product_category}}</td>
                                                                 <td>{{$lead->  phone}}</td>
                                                                 
                                                                 <td>{{$lead->partnership_package_name}}</td>
                                                                 <td>{{$lead->partnership_package_value}}</td>
                                                                 <td>
                                                                  <a  href="{{ URL::to('/marketing/editlead', array('leadid' => $lead->id)) }}"><i class="fa fa-pencil">Edit</i></a>&nbsp;&nbsp;
                                                                  
												 <a  href=""  class="reassign"  data-toggle="modal"  id="lead_<?php echo $lead->id ?>" data-target="#reassign"><i class="fa fa-pencil"></i>Assign</a>
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
			 <div class="modal bounceIn animated" id="reassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Re Assign lead</h3>
                        </div>
                        <form action="{{ url('/marketing/reassignlead') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                            <p>To whom you want assign ?</p>
                            <table width="100%"  class="table">
                              <tr><td>
                              <input type="hidden" name="leadid" id="leadid"  value=""/>
                              
                                <select class="form-control" name="assignedid">
                <option value="NULL">Select</option>
                 @foreach($salesman_list as $list)
                  <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>
                 @endforeach
                </select>
                
                            </td></tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
</section>


<script>

$(document).ready(function() {

  'use strict';

    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
 
	$('.reassign').click(function(e) {

            var leadid , lead,lead1;
            leadid =$(this).attr('id');
            lead =leadid.split('_');
            lead1=lead[1];
            // alert(del1);

            $("#reassign #leadid").val( lead1 );

            });
			
			$( "#emp_id" ).autocomplete({
			  source: "/search/autocomplete?employeeName=1",
			  minLength: 3,
			  select: function(event, ui) {
				$('#emp_id').val(ui.item.value);
			  }
			});
			
			$( "#company" ).autocomplete({
			  source: "/search/autocomplete?companyName=1",
			  minLength: 1,
			  select: function(event, ui) {
				$('#company').val(ui.item.value);
			  }
			});
});

</script>

@endsection
