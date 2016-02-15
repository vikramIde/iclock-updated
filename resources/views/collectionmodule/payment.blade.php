@extends('app')

@section('content')

<?php $totalPayment=0 ; $totalAdjustment=0;?>
   
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
      $clone.find('.dob').removeAttr('id').removeClass('hasDatepicker');
         $clone.find('.dob').datepicker({
            dateFormat: 'dd-mm-yy',
           minDate: '0',

         });

         $tr.closest('table').append($clone);
     });

     // $("#table-data").on('change', 'select', function () {
     //     var val = $(this).val();
     //     $(this).closest('tr').find('input:text').val(val);
     // });

     
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
            <?php if(Auth::User()->role=='collector'){ ?>      
            <li class="nav-parent ">
              <a href=""><i class="fa fa-home"></i><span> Dashboard</span></a>
             
             <ul class="children">
                <li ><a class="ajax-link" href="{{ URL::to('collection/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a></li>
            
              </ul>
            </li>
              <li class="nav-parent active">
              <a href=""><i class="fa fa-money"></i><span> Receive Payment</span></a>
             
             <ul class="children">
                <li class="active"><a class="ajax-link" href=""><i class="fa fa-money"></i><span> Receive Payment</span></a></li>
            
              </ul>
            </li>
        
            <?php } ?>
          </ul>
        </div><!-- tab-pane -->

    

      </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <?php
                 
    date_default_timezone_set('Asia/Kolkata');
    $today=date('d-m-Y g:i a');

    ?>
 
<div class="contentpanel">
      <ol class="breadcrumb breadcrumb-quirk">
        <li><a ><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a >Dashbord</a></li>
        <li class="active">Receive Payment</li>
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

<?php foreach($invoice as $data) { ?>
      <div class="row" >
        <div class="col-md-12 col-lg-8 dash-left" id="p_box_1">
         

          <div class="panel panel-site-traffic">
            <div class="panel-heading">
              <ul class="panel-options">
                <li><a><i class="fa fa-refresh"></i></a></li>
              </ul>
              <h4 class="panel-title text-success">Receive Payment</h4>
             <!--  <p class="nomargin">Past 30 Days — Last Updated July 14, 2015</p> -->
            </div>
            <div class="panel-body">
            
                <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-stats-bars"></div>
                  </div>
                  <div class="pull-left">
                    <h4 class="panel-title">Company Name</h4>
                   <p>&nbsp;</p>
                    <h5 class="text-success"><?php echo $data->Companyname ?></h5>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-calendar"></div>
                  </div>
                  <h4 class="panel-title">Event Name</h4>
                  <!-- <h3>38.10</h3> --><p>&nbsp;</p>
                  <h5 class="text-success"><?php echo $data->EventName ?></h5>
                </div>
                 <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-calendar"></div>
                  </div>
                  <h4 class="panel-title">Event Name</h4>
                  <!-- <h3>38.10</h3> --><p>&nbsp;</p>
                  <h5 class="text-success"><?php echo $data->EventName ?></h5>
                </div>

           
              <p>&nbsp;</p>
              
                <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-person"></div>
                  </div>
                  <h4 class="panel-title">Sales Representative</h4>
                  <!-- <h3>4:45</h3> --><p>&nbsp;</p>
                  <h5 class="text-success"><?php echo $data->RepresentativeNo ?> <?php if(strlen($repName) > 0) echo ",".$repName;  ?></h5>
                </div>
                  <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-cash"></div>
                  </div>
                  <h4 class="panel-title">Total Amount</h4>
                 <p>&nbsp;</p>
                  <h5 class="text-success"><?php echo $data->GrandTotal ?></h5>
                </div>
                 <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-cash"></div>
                  </div>
                  <h4 class="panel-title ">Balance Amount</h4>
                  <!-- <h3>38.10</h3> --><p>&nbsp;</p>
                 <h5 class="text-danger">
                  <?php if(count($data->payments) > 0) { ?>
                   @foreach($data->payments as $payment)
                                                    <?php $totalPayment += $payment->recieved_amount; ?>
                                                    <?php $totalAdjustment += $payment->adjust_amount; ?>

                                             
                                                     @endforeach


                                                     <?php
                                                   }
												   if($data->GrandTotal-$totalPayment -$totalAdjustment ==0)
													   $dueflag=1;
												   else
													   $dueflag=0;
                                                   ?>
						
                                                    {{  $data->GrandTotal - $totalPayment - $totalAdjustment}}.00
                 </h5>
                </div>
           

              <div class="mb20"></div>

            

            </div><!-- panel-body -->

           

          </div><!-- panel -->
    


        </div><!-- col-md-9 -->
       <!-- col-md-3 -->
      </div><!-- row -->

            <div class="row panel-statistics">
             <div class="col-md-12 col-lg-8">
        <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Payments</h4>
          <!-- <p>DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p> -->
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/collection/payment') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <input type="hidden" name="invoiceid" value="<?php echo  $data->Id ?>" /> 
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Ref no </th>
                  <th>Adjustment Mode</th>
                  <th>Adjustment Amount</th>
                              
                </tr>
              </thead>


              <tbody>
                 <?php if(count($data->payments) > 0) { ?>
                                                    @foreach($data->payments as $payment)
                                                   <!--  <?php $totalPayment += $payment->recieved_amount; ?>
                                                    <?php $totalAdjustment += $payment->adjust_amount; ?> -->
                                                   
                                                    <tr style="text-align:left">
                                                        <td>
                                                           {{$payment->recieved_amount}}
                                                        </td>
                                                        <td>
                                                           {{$payment->date}}
                                                        </td>
                                                        <td>
                                                           {{$payment->refno}}
                                                        </td>
                                                        <td>
                                                          {{$payment->adjust_mode}}
                                                        </td>
                                                        <td style="text-align:right">
                                                        {{$payment->adjust_amount}}
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    @endforeach
                                                 <?php } ?>
                                               </tbody>
                                             </table>
                                             <table  id="table-data"class="table table-bordered table-striped-col">
                       <tr>
                        <td>
                            <input type="text" value="" class="form-control" autocomplete="off" name="recieved_amount[]" placeholder="Amount">
                        </td>
                        <td>
                            <input type="text" value="" class="form-control dob" autocomplete="off" name="date[]"  placeholder="Date">
                        </td>
                        <td>
                            <input type="text" value="" class="form-control" autocomplete="off" name="ref_no[]"  placeholder="Reference Number">
                        </td>
                        <td>
                            <select class="form-control" name="adjustmentmode[]">
                                 <option >-- Select Adjust Mode --</option>
                                <option >TDS</option>
                                <option >Overseas Bank Charges</option>
                                <option >MISC</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" value="" class="form-control" autocomplete="off" name="adjustmentamount[]" placeholder="Adjustment Amount">
                        </td>
                        <td>
                            <input type="button" class="btn btn-default addButton" value="Add" />
                        </td>
                        </tr>

                
              </tbody>
            </table>
            <h4>Payment comment *</h4>
            <textarea type="text" value="" class="form-control" autocomplete="off"  rows="1" cols="50" placeholder="Comment" name="comment" ></textarea>
			<input type="hidden" value="<?php echo $dueflag; ?>" name="dueflag" />
            <input type="hidden" value="<?php  echo $today;  ?>" name="date1"  />&nbsp;
            <center>
            <input type="submit" class="btn btn-info" value="Submit Payment">
            </center>
          </form>
          </div>
        </div>
      </div><!-- panel -->
       </div>
      </div>

       <div class="row ">
             <div class="col-md-6 col-lg-6 dash-left">
        <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Comments</h4>
          <!-- <p>DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p> -->
        </div>
        <div class="panel-body" style="overflow-y:scroll;height:250px">
         <?php if(count($data->comments) > 0) { ?>
                                                            @foreach($data->comments as $comment)
                                                            <ul class="chat" style="list-style:none">
                                                             
                                                                <li class="left clearfix">
                                                                  
                                                                    <div class="chat-body clearfix">
                                                                        <div class="header">
                                                                        
                                                                            <small class="pull-right text-muted">
                                                                                <i class="fa fa-clock-o fa-fw"></i> {{$comment->date}}
                                                                            </small>
                                                                        </div>
                                                                            <p><span style="color:green;font-weight: bold;">
																				{{$comment->commentmode}}
																			</span>
                                                                                {{$comment->text}}
                                                                            </p>
																			
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                               @endforeach
                                                                                 <?php } 
                                                                                      else echo "No comments available";
                                                                                 ?>
        </div>
        <div class="panel-header">
												<form method="POST" action="{{ url('/collection/comment') }}">
														  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
														   <input type="hidden" value="<?php  echo $today;  ?>"  name="date1"  >
														   <input type="hidden" name="invoiceid" value="<?php echo $data->Id ?>" /> 
													<div class="panel-footer">
														<div class="input-group">
															<input type="text" value="" class="form-control future"  autocomplete="off" style="width:60%" name="nextduedate"  placeholder="Due Date">
															
															<div ><textarea class="form-control" rows="1" cols="30" name="comment" ></textarea><span class="input-group-btn">
																<input type="submit" style="width: 149px;" class="btn btn-info" value="Submit Comment">
															</span></div>
															
														</div>
													</div>
												</form> 
        </div>

        </div>
        </div>
        <div class="col-md-6 col-lg-6 dash-right">
        <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Adjustments</h4>
          <!-- <p>DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p> -->
        </div>
        <div class="panel-body">
			<form method="POST" action="{{ url('/collection/adjustment') }}" class="form-horizontal" role="form" >
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					</br>
					  </br>
						</br><input type="hidden" name="invoiceid" value="<?php echo $data->Id ?>" /> 
						  <div class="form-group">
						  <label class="col-md-4 control-label">Date</label>
						  <div class="col-md-6">
							 <input type="text" value="" class="form-control dob" autocomplete="off" name="date"  placeholder="Date">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label" name="adjustmentmode">Adjustment Mode</label>
						  <div class="col-md-6">
							 <select class="form-control" name="adjustmentmode">
											<option >-- Select Adjust Mode --</option>
											<option >TDS</option>
											<option >Overseas Bank Charges</option>
											<option >MISC</option>
										</select>
							</div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label">Adjustment Amount</label>
						  <div class="col-md-6">
							 <input type="text" value="" class="form-control" autocomplete="off" name="adjustmentamount" placeholder="Adjustment Amount">
						  </div>
						</div>
						<!---<div class="form-group">
						  <label class="col-md-4 control-label">Comment</label>
						  <div class="col-md-6">
							 <textarea name="comment" placeholder="Comments" cols="35"></textarea>
						  </div>
						</div>--->
						<div class="form-group">
						  <label class="col-md-4 control-label"></label>
						  <div class="col-md-6">
							  <button type="submit" class="btn btn-primary">
							  Submit
							</button>
						  </div>
						</div>
								

			</form>
        
							</br></br></br>
        </div>
   
        </div>
        </div>
      </div>


     <?php } ?>
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>


<script>

$(document).ready(function() {

  'use strict';

    $('#dataTable1').DataTable();
    $('#dataTable2').DataTable();
 

});
$(function() {

  // Textarea Auto Resize
  autosize($('#autosize'));

  // Select2 Box
  $('#select1, #select2, #select3').select2();
  $("#select4").select2({ maximumSelectionLength: 2 });
  $("#select5").select2({ minimumResultsForSearch: Infinity });
  $("#select6").select2({ tags: true });

  // Toggles
  $('.toggle').toggles({
    on: true,
    height: 26
  });

  // Input Masks
  $("#date").mask("99/99/9999");
  $("#phone").mask("(999) 999-9999");
  $("#ssn").mask("999-99-9999");

  // Date Picker
  $('.dob').datepicker(
    {
            dateFormat: 'dd-mm-yy',
            maxDate: '0',

         }
    );
	$('.future').datepicker(
    {
            dateFormat: 'yy-mm-dd',
            minDate: '0',

         }
    );
  $('#datepicker-inline').datepicker();
  $('#datepicker-multiple').datepicker({ numberOfMonths: 2 });

  // Time Picker
  $('#tpBasic').timepicker();
  $('#tp2').timepicker({'scrollDefault': 'now'});
  $('#tp3').timepicker();

  $('#setTimeButton').on('click', function (){
    $('#tp3').timepicker('setTime', new Date());
  });

  // Colorpicker
  $('#colorpicker1').colorpicker();
  $('#colorpicker2').colorpicker({
    customClass: 'colorpicker-lg',
    sliders: {
      saturation: {
        maxLeft: 200,
        maxTop: 200
      },
      hue: { maxTop: 200 },
      alpha: { maxTop: 200 }
    }
  });

});
</script>

@endsection
