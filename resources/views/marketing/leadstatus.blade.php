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
                <li ><a href="{{ URL::to('marketing/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                <li class="active"><a href="{{ URL::to('marketing/leadstatus')}}"><i class="fa fa-line-chart"></i><span>Lead Status</span></a></li>
                

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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Lead Status</strong></a></li>
         
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
                <form class="form-horizontal">
                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                         @foreach($edetails as $en)

                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
                                      <input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
                                      @endforeach
                                      <div class="row">
                                      
                                        <div class="col-md-12">
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
                                                                      <th>Status</th>
                                                                      <th>Actions</th>
                                                                    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  @foreach($mleads as $lead)
                                                                 
                                                                
                                                                  <tr>
                                                                    <td>{{$lead->leadcode}}</td>
                                                                 <td>{{$lead->company_name}}</td>
                                                                 <td>{{$lead->product_category}}</td>
                                                                 <td>{{$lead->  phone}}</td>
                                                                 
                                                                 <td>{{$lead->partnership_package_name}}</td>
                                                                 <td>{{$lead->partnership_package_value}}</td>
                                                                  <td>{{$lead->partnership_package_value}}</td>
                                                                 <td>
                                                                  <a  href="{{ URL::to('/marketing/viewlead', array('leadid' => $lead->id)) }}"><i class="fa fa-pencil">View</i></a>&nbsp;&nbsp;
                                                                  
                         
                                                                 </td>

                                                                  </tr>
                                                                  @endforeach
                                                                </tbody>
                                                            </table>
                                                          </div>
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
