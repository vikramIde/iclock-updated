@extends('app')

@section('content')

 <!-- <script type='text/javascript' src="{{asset('js/jquery-1.11.2.min.js')}}"></script> -->
  <script type="text/javascript">
            $(function () {
     $("#table-data").on('click', 'input.addButton', function () {
         var $tr = $(this).closest('tr');
         var allTrs = $tr.closest('table').find('tr');
         var lastTr = allTrs[allTrs.length - 1];
         var $clone = $(lastTr).clone();
         $clone.find('td').each(function () {
             var el = $(this).find(':first-child');
             var id = el.attr('id') || null;
               var name = el.attr('name') || null;
             if (id) {
                 var i = id.substr(id.length - 1);
                 var prefix = id.substr(0, (id.length - 1));
                 el.attr('id', prefix + (+i + 1));
                 el.attr('name', name);
             }
         });
         $clone.find('input:text').val('');


         $tr.closest('table').append($clone);
     });

  
     
 });
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	
	$('#updatePopup').on('change',function(){
			//alert(($(this).val()));
			if($(this).val() == 'Update'){
				var $str='<table><thead><tr><td>Empid</td><td>Empname</td><td>Position</td><td>Teamname</td></tr></thead>';
				$('table input[type=checkbox]:checked').each(function() {
					// Do something interesting
					var name = $(this).parent().parent().find('td:eq(1)').text();
					//alert(name);
					
					$str +="<tbody><tr><td><input type='hidden' value='"+name+"'  name='name[]' />"+name+"  </td><td>Empname</td><td>Position</td><td>Teamname</td></tr></tbody>";
					
				});
				$str +='</table>';
				$('#teamName').html($str);
				//open PopUp here
				
				
			}
		 
	});
    
});
 </script>

<section>

  <div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->


      <div class="tab-content">

        <!-- ################# MAIN MENU ################### -->

        <div class="tab-pane active" id="mainmenu">
         

          <h5 class="sidebar-title">Main Menu</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <?php if(Auth::User()->role=='crmadmin'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li class="active"><a class="ajax-link" href="{{ URL::to('crm/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
             <li class="nav-parent active ">
              <a href=""><i class="fa fa-home"></i><span> Team Management</span></a>
             
             <ul class="children">
                <li class="active"><a class="ajax-link" href="{{ URL::to('crm/addteam')}}"><i class="fa fa-home"></i><span> Team Management</span></a></li>
            
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
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Create Team</strong></a></li>
            <li><a href="#recent5" data-toggle="tab"><strong>Team Allocation</strong></a></li>
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
                            
             

           <form class="form-horizontal" role="form" method="POST" action="{{ url('/crm/createteam') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table" id="table-data">
              <tr>
                <td> <label class="col-md-4 control-label">Team Name(s)</label></td>
                <td> <input type="text" class="form-control" name="teamname[]"></td>
                <td>   <input type="button" class="btn btn-default addButton" value="+" /></td>
              </tr>
             
            </table>
<center><input type="submit" class="btn btn-primary" name="submit" value="Submit"></center>
            </form>

                                                       
            </div>
            <div class="tab-pane" id="recent5">
                         <form class="form-horizontal" role="form" method="POST" action="{{ url('/crm/teamallocate') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <table width="30%">
              <tr><td> <input type="checkbox" id="selecctall"> Check All</td>
            
                <td ><select id="updatePopup" data-toggle="modal"   data-target="#eventModal" class="form-control">
                   <option>--Select--</option>
                <option >Update</option></select></td></tr>
            </table>
          </br>
            <table class="table" id="dataTable1">
               <thead >
                                                                    <tr>
                                                                      <th></th>
                                                                       <th>Emp Id</th>
                                                                        <th>Emp Name</th>
                                                                       
                                                                        
                                                                        <th>Position</th>
                                                                        <th>Teamname</th>
                                                                          <th>Emp Status</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($empdet as $emp)
                                                                  <tr>
                                                                  
                                                                <td><input class="checkbox1" type="checkbox" name="check[]" value="1"></td>
                                                                   <td>{{$emp->emp_ide_id}}</td>
                                                                  <td  >{{$emp->emp_name}}</td>
                                                               
                                                                  <td ><select class="form-control"><option>--Select--</option>
                                                                    <option value="TL">TL</option>
                                                                   <option value="PTL">PTL</option></select></td>
                                                                  <td > 
                                                                    <select class="form-control" name="teamalloted">
                                                                      <option>--Select--</option>
                                                                      @foreach($teamnames as $teamn)
                                                                      <option value="{{$teamn->teamname}}|{{$teamn->id}}"> {{$teamn->teamname}}</option>
                                                                      @endforeach
                                                                    </select>

                                                                  </td>
                                                                   <td style="width:120px">
                                                                  <?php
                                                                if($emp->emp_status=='Active'){
                                                                    ?>
                                                                    <span class="btn btn-success">{{$emp->emp_status}}<span>
                                                                  <?php }
                                                                  else {
                                                                  ?>
                                                                <span class="btn btn-danger">{{$emp->emp_status}}<span>
                                                                  <?php 
                                                                }?>
                                                                  </td>
                                                                  
                                                                </tr>
                                                                   @endforeach
                                                              </tbody>
            </table>
       

            </form>   
                       
            </div>
            
              
        </div><!-- col-md-6 -->

      </div><!-- row-->

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>

     <div class="modal bounceIn animated" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Event</h3>
                        </div>
                        <form action="" method="post"  enctype="multipart/form-data">
                          <div id="teamName">
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
 

});
</script>

  
@endsection