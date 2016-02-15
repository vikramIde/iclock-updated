@extends('app')



@section('content')

<!-- <script type='text/javascript' src="{{asset('js/jquery-1.11.2.min.js')}}"></script> -->

<section>

@foreach($emp as $en)



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

            <?php if(Auth::User()->role=='sales'){ ?>      

            <li class="nav-parent ">

              <a href="{{ URL::to('initiator/home')}}"><i class="fa fa-home"></i><span> Dashboard</span></a>

           <ul class="children">

                <li  class="active"><a  href="{{ URL::to('initiator/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>

            

              </ul>

            </li>

                <li class="nav-parent active">

              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>

             

             <ul class="children">

                <li class="active"><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>

                 <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>

               <li><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs</span></a></li>

                  <li><a href="{{ URL::to('initiator/dealclose')}}"><i class="fa fa-line-chart"></i><span> Pending for  Deal Closed</span></a></li>

                   <li><a href="{{ URL::to('initiator/blowoutleads')}}"><i class="fa fa-line-chart"></i><span> Blowout Leads</span></a></li>

               

              </ul>

            </li>

           <li class="nav-parent ">

              <a href=""><i class="fa fa-pencil-square-o"></i><span> Deals</span></a>

             

             <ul class="children">

                <li><a  href="{{ URL::to('initiator/mycancellation')}}"><i class="fa fa-pencil-square-o"></i><span> My Cancellation</span></a></li>

                  <li><a  href="{{ URL::to('initiator/deals')}}"><i class="fa fa-pencil-square-o"></i><span> My Deals</span></a></li>

                        <?php
                              if($en->emp_department=='Delegates')
                              {
                                ?>
                   <li ><a  href="{{ URL::to('initiator/pendingactivity')}}"><i class="fa fa-pencil-square-o"></i><span> My Pending Activity</span></a></li>
            <?php
          }
          ?>

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

  @foreach($lead_id as $leadname)

        <div class="col-md-12">

          <div class="panel">

              <div class="panel-heading nopaddingbottom">

                <h4 class="panel-title">Lead Information</h4>

                

              </div>



              <div class="panel-body">

  <hr>

                <div class="row">



        <div class="col-md-4">

          <div class="panel">

              <div class="panel-heading nopaddingbottom">

                <h4 class="panel-title">Company Validation</h4>

               

              </div>

              <div class="panel-body">

                <hr>

                <form  class="form-horizontal">

                  <div class="form-group">

                    <label class="col-sm-6">Company Name  :</label>

                    <div class="col-sm-6">

                      {{$leadname->company_name}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Product Category  :</label>

                    <div class="col-sm-6">

                     {{$leadname->product_category}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Board Line  :</label>

                    <div class="col-sm-6">

                    {{$leadname->phone}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Fax  :</label>

                    <div class="col-sm-6">

                      {{$leadname->fax}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Package Name :</label>

                    <div class="col-sm-6">

                      {{$leadname->partnership_package_name}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Package Value  :</label>

                    <div class="col-sm-6">

                     {{$leadname->partnership_package_value}}

                    </div>

                  </div>





                  <hr>





                </form>

              </div><!-- panel-body -->

          </div><!-- panel -->



        </div><!-- col-md-6 -->



        <div class="col-md-4">

          <div class="panel">

              <div class="panel-heading nopaddingbottom">

                <h4 class="panel-title">Decision Maker</h4>

             

              </div>

              <div class="panel-body nopaddingtop">

                <hr>

                <form id="basicForm2" action="form-validation.html" class="form-horizontal">



                          <div class="form-group">

                    <label class="col-sm-6">Name  :</label>

                    <div class="col-sm-6">

                      {{$leadname->dmname}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Direct Line :</label>

                    <div class="col-sm-6">

                     {{$leadname->dmphone}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Email  :</label>

                    <div class="col-sm-6">

                   {{$leadname->dmemail}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Designation  :</label>

                    <div class="col-sm-6">

                    {{$leadname->dmdesignation}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Mobile :</label>

                    <div class="col-sm-6">

                     {{$leadname->dmmobile}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Alternate Number :</label>

                    <div class="col-sm-6">

                   {{$leadname->dmaltnumber}}

                    </div>

                  </div>



                  <hr>



                </form>

              </div><!-- panel-body -->

          </div><!-- panel -->





        </div><!-- col-md-6 -->

 <div class="col-md-4">

          <div class="panel">

              <div class="panel-heading nopaddingbottom">

                <h4 class="panel-title">Influencer</h4>

               

              </div>

              <div class="panel-body nopaddingtop">

                <hr>

                <form id="basicForm2" action="form-validation.html" class="form-horizontal">

  
   <div class="form-group">

                    <label class="col-sm-6">Name  :</label>

                    <div class="col-sm-6">

                      {{$leadname->infname}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Direct Line :</label>

                    <div class="col-sm-6">

                     {{$leadname->infphone}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Email  :</label>

                    <div class="col-sm-6">

                   {{$leadname->infemail}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Designation  :</label>

                    <div class="col-sm-6">

                    {{$leadname->infdesignation}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Mobile :</label>

                    <div class="col-sm-6">

                     {{$leadname->infmobile}}

                    </div>

                  </div>

                    <div class="form-group">

                    <label class="col-sm-6">Alternate Number :</label>

                    <div class="col-sm-6">

                   {{$leadname->infaltnumber}}

                    </div>

                  </div>




                  <hr>



                </form>

              </div><!-- panel-body -->

          </div><!-- panel -->





        </div><!-- col-md-6 -->

      </div><!--row -->

      
                <div class="row">

        <div class="col-md-4">
          <div class="panel">
              <div class="panel-heading nopaddingbottom">
                <h4 class="panel-title">Specifier</h4>
               
              </div>
              <div class="panel-body">
                <hr>
                <form  class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-6">Name  :</label>
                    <div class="col-sm-6">
                      {{$leadname->specname}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Direct Line :</label>
                    <div class="col-sm-6">
                     {{$leadname->specphone}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Email  :</label>
                    <div class="col-sm-6">
                    {{$leadname->speemail}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Designation  :</label>
                    <div class="col-sm-6">
                    {{$leadname->specdesignation}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Mobile :</label>
                    <div class="col-sm-6">
                   {{$leadname->spemobile}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Alternate Number  :</label>
                    <div class="col-sm-6">
                    {{$leadname->spealtnumber}}
                    </div>
                  </div>


                  <hr>


                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->

        </div><!-- col-md-6 -->

        <div class="col-md-4">
          <div class="panel">
              <div class="panel-heading nopaddingbottom">
                <h4 class="panel-title">Remarks</h4>
             
              </div>
              <div class="panel-body nopaddingtop">
                <hr>
                <form id="basicForm2" action="form-validation.html" class="form-horizontal">

                          <div class="form-group">
                    <label class="col-sm-6">Remarks  :</label>
                    <div class="col-sm-6">
                    {{$leadname->remarks}}
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="col-sm-6">Competitors :</label>
                    <div class="col-sm-6">
                     {{$leadname->competitors}}
                    </div>
                  </div>
                 

                  <hr>

                </form>
              </div><!-- panel-body -->
          </div><!-- panel -->


        </div><!-- col-md-6 -->

      </div><!--row -->

                <hr>

                <form id="basicForm" action="form-validation.html" class="form-horizontal">



                </form>

              </div><!-- panel-body -->

          </div><!-- panel -->



        </div><!-- col-md-6 -->

     @endforeach

      </div><!--row -->





      <div class="row">

           <div class="col-md-12">

          <div class="panel">

              <div class="panel-heading nopaddingbottom">

                <h4 class="panel-title">Previous Call History</h4>

               <p></p>

              </div>

              <div class="panel-body">

            <hr>

                 <div class="table-responsive">

             <table  id="dataTable1" class="table table-bordered table-striped-col">

                                                                <thead >

                                                                    <tr >

                                                                      <th>Lead ID</th>

                                                                      <th>Emp Id & Name</th>

                                                                      <th>Time of call</th>

                                                                      <th>Results</th>

                                                                      <th>Next call Date & Time</th>

                                                                      <th>Schedule</th>
                                                                        <th>Pitched Person</th>

                                                                      

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                  @foreach($leadscallback as $leadcall)

                                                                  <tr>

                                                                    <th>{{$leadcall->leadcode}}</th>

                                                                      <th>{{$leadcall->empid}}-{{$leadcall->empname}}</th>

                                                                   <th><?php

                                                                   $time=$leadcall->timeofcall;

                                                                    $timef=date('h:i:s a', strtotime($time));

                                                                    echo $timef;

                                                                   ?></th>

                                                                      <th>{{$leadcall->results}}</th>

                                                                      <th>

                                                                        <?php

                                                                   $time=$leadcall->nextcalldate;

                                                                    $timef=date('h:i:s a : m-d-Y', strtotime($time));

                                                                    echo $timef;

                                                                   ?></th>

                                                                      <th>{{$leadcall->schedule}}</th>
                                                                         <th>{{$leadcall->pitchedperson}}</th>

                                                                  </tr>

                                                                  @endforeach

                                                                </tbody>

                                                            </table>

                                                          </div>

              </div>

            </div>

          </div>

      </div>

      <div class="row">



             <div class="col-md-12">



         

          <!-- Nav tabs -->

          <ul class="nav nav-tabs nav-primary">

            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Call Back Sheet</strong></a></li>

           

           

          </ul>



          <!-- Tab panes -->

          <div class="tab-content mb20">



            <div class="tab-pane active" id="popular5"> 

         

 @foreach($emp as $en)



                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">

                                      @endforeach

                   

                                                        </br>

<?php 



if($leadname['callback']=='0'){



  ?>





<div>





                                                        <center><h4><u>CALL BACK MANAGEMENT</u></h4></center>

                                                      </br>

                <form action="{{ url('/initiator/callbackform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                         <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach

                                   



                                         <div class="form-group">

                                        <label class="col-md-2 control-label">  Time of call</label>

                                        <div class="col-md-2">

                                           <input id="tpBasic" type="text" name="timeofcall" class="form-control"/>

                                        </div>

                                        <div class="col-md-2">

                                            

                                           



                                        </div>

                                         <label class="col-md-2 control-label"> Results</label>

                                        <div class="col-md-2">

                                          <textarea class="form-control" name="results"></textarea>

                                        </div>

                                        </div>

                                            <div class="form-group">

                                        <label class="col-md-2 control-label"> Next Call Date</label>

                                        <div class="col-md-2">

                                             <input type="text" class="form-control dob"  autocomplete="off" name="nextcalldate">



                                           

                                        </div>

                                        <div class="col-md-2">

                                            

                                            <input id="tp2" type="text" name="nexttime" class="form-control"/>



                                        </div>

                                         <label class="col-md-2 control-label">  Schedule </label>

                                        <div class="col-md-2">

                                            <textarea class="form-control" name="schedule"></textarea>

                                        </div>

                                        </div>
                                           <div class="form-group">

                                        <label class="col-md-2 control-label"> Pitched Person</label>

                                        <div class="col-md-2">
                                          <select class="form-control" name="pitchedperson">
                                            <option>--Select--</option>
                                            <option value="Decision Maker">Decision Maker</option>
                                              <option value="Influencer">Influencer</option>
                                                <option value="Specifier">Specifier</option>
                                          </select>

                                        </div>


                                        </div>

                                         <div class="form-group">

                                        <label class="col-md-6 control-label"> </label>

                                        <div class="col-md-4">

                                           <input type="submit" class="btn btn-primary" name="submit" value="Save">

                                        </div>

                                        </div>

                                

                                      

</form>

</br>

<div class="row">

  <div class="col-md-6">

       <center><h4><u>CALL BACK ASSIGN</u></h4></center>

                                                      </br>

                <form action="{{ url('/initiator/callbackassign') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                         @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach



                                   <div class="form-group">

                                        <label class="col-md-3 control-label"> Assign call back to</label>

                                        <div class="col-md-4">



                                           <?php

                              if($en->emp_department=='Vendors')

                              {

                                ?>

                                          <select class="form-control" name="assignedid">

                                          <option value="NULL">Select</option>

                                           @foreach($salesman_list as $list)

                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>

                                           @endforeach

                                          </select>



                                          <?php

               } if($en->emp_department=='Delegates'){

                ?>

                  <select class="form-control" name="assignedid">

                                          <option value="NULL">Select</option>

                                           @foreach($dellist as $list)

                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>

                                           @endforeach

                                          </select>



                                              <?php 

               }

                  ?>

                                        </div>

                                        <div class="col-md-2">

                                            

                                            <input type="submit" class="btn btn-primary" name="submit" value="Assign">



                                        </div>

                                        

                                        </div>

                                   

                                

                                      

</form>

  </div>

  <div class="col-md-6">

              <center><h4><u>DEAL CLOSE</u></h4></center>

                                                      </br>

                                                      <div class="form-group">

                                        <label class="col-md-3 control-label"> </label>

                                        <div class="col-md-3">

                                                 <form action="{{ url('/initiator/dealclosing') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach



                                  <input type="submit" class="btn btn-primary" name="submit" value="Deal Close">

                                  

</form>

                                        </div>

                                        <div class="col-md-3">

                                            

                                       <form action="{{ url('/initiator/blowoutdeal') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach



                                  <input type="submit" class="btn btn-primary" name="submit" value="Blow Out">

                                   

                                

                                      

</form>



                                        </div>

                                        

                                        </div>

      

  </div>

</div>





</div>



<?php

}  



elseif($leadname['callbackassignid']==$en['emp_ide_id']){

?>





<div>





                                                        <center><h4><u>CALL BACK MANAGEMENT</u></h4></center>

                                                      </br>

                <form action="{{ url('/initiator/callbackform') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                      <input type="hidden" name="leadcode" value="{{$leadedit->leadcode}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach



                                         <div class="form-group">

                                        <label class="col-md-2 control-label">  Time of call</label>

                                        <div class="col-md-2">

                                           <input id="tpBasic" type="text" name="timeofcall" class="form-control"/>

                                        </div>

                                        <div class="col-md-2">

                                            

                                           



                                        </div>

                                         <label class="col-md-2 control-label"> Results</label>

                                        <div class="col-md-2">

                                          <textarea class="form-control" name="results"></textarea>

                                        </div>

                                        </div>

                                            <div class="form-group">

                                        <label class="col-md-2 control-label"> Next Call Date</label>

                                        <div class="col-md-2">

                                             <input type="text" class="form-control dob"  autocomplete="off" name="nextcalldate">



                                           

                                        </div>

                                        <div class="col-md-2">

                                            

                                            <input id="tp2" type="text" name="nexttime" class="form-control"/>



                                        </div>

                                         <label class="col-md-2 control-label">  Schedule </label>

                                        <div class="col-md-2">

                                            <textarea class="form-control" name="schedule"></textarea>

                                        </div>

                                        </div>
                                               <div class="form-group">

                                        <label class="col-md-2 control-label"> Pitched Person</label>

                                        <div class="col-md-2">
                                          <select class="form-control" name="pitchedperson">
                                            <option>--Select--</option>
                                            <option value="Decision Maker">Decision Maker</option>
                                              <option value="Influencer">Influencer</option>
                                                <option value="Specifier">Specifier</option>
                                          </select>

                                        </div>


                                        </div>

                                         <div class="form-group">

                                        <label class="col-md-6 control-label"> </label>

                                        <div class="col-md-4">

                                           <input type="submit" class="btn btn-primary" name="submit" value="Save">

                                        </div>

                                        </div>

                                

                                      

</form>

</br>

  <div class="row">

  <div class="col-md-6">

       <center><h4><u>CALL BACK ASSIGN</u></h4></center>

                                                      </br>

                <form action="{{ url('/initiator/callbackassign') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach



                                   <div class="form-group">

                                        <label class="col-md-3 control-label"> Assign call back to</label>

                                        <div class="col-md-4">

                                          

                                           <?php

                              if($en->emp_department=='Vendors')

                              {

                                ?>

                                          <select class="form-control" name="assignedid">

                                          <option value="NULL">Select</option>

                                           @foreach($salesman_list as $list)

                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>

                                           @endforeach

                                          </select>



                                          <?php

               } if($en->emp_department=='Delegates'){

                ?>

                  <select class="form-control" name="assignedid">

                                          <option value="NULL">Select</option>

                                           @foreach($dellist as $list)

                                            <option value="{{$list->emp_ide_id}}|{{$list->emp_name}}">{{$list->emp_name}}</option>

                                           @endforeach

                                          </select>



                                              <?php 

               }

                  ?>

                                        </div>

                                        <div class="col-md-2">

                                            

                                            <input type="submit" class="btn btn-primary" name="submit" value="Assign">



                                        </div>

                                        

                                        </div>

                                   

                                

                                      

</form>

  </div>

  <div class="col-md-6">

       <center><h4><u>DEAL CLOSE</u></h4></center>

                                                      </br>

                                                      <div class="form-group">

                                        <label class="col-md-3 control-label"> </label>

                                        <div class="col-md-3">

                                                 <form action="{{ url('/initiator/dealclosing') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">

<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">

@endforeach

                                  <input type="submit" class="btn btn-primary" name="submit" value="Assign Deal Close">

                                   

                                

                                      

</form>

                                        </div>

                                        <div class="col-md-3">

                                            

                                                     <form action="{{ url('/initiator/blowoutdeal') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">

                                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                      

                                      @foreach($lead_id as $leadedit)

                                      <input type="hidden" name="lead_edit_id" value="{{$leadedit->id}}">

                                        

                                          @endforeach

                                          @foreach($emp as $en)



                                      <input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->empid}}|{{$en->name}}">

                                      @endforeach



                                  <input type="submit" class="btn btn-primary" name="submit" value="Blow Out">

                                   

                                

                                      

</form>



                                        </div>

                                        

                                        </div>

      

  </div>

</div>



</div>

<?php 

}

elseif(($leadname['empid']==$en['empid'])&& ($leadname['dealclose']=='1')){

?>

<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for deal close '; echo ' '; echo 'by'; echo ' '; echo '"';

echo $leadname['dealclosebyid']; echo ' ';echo '-';  echo ' ';echo $leadname['dealclosebyname']; echo '"'; echo'</strong>';?>





<?php 

}

elseif(($leadname['empid']==$en['empid'])&& ($leadname['blowout']=='1')){

?>

<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for deal close '; echo ' '; echo 'by'; echo ' '; echo '"';

echo $leadname['blowoutbyid']; echo ' ';echo '-';  echo ' ';echo $leadname['blowoutbyname']; echo '"'; echo'</strong>';?>



<?php

}

else{

  ?>

<?php echo '<strong style="color:green">'; echo 'This lead has been assgined for callback '; echo ' '; echo 'to'; echo ' '; echo '"';

echo $leadname['callbackassignid']; echo ' ';echo '-';  echo ' ';echo $leadname['callbackassignname']; echo '"'; echo'</strong>';?>



<?php

}

?>



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

 







  $('.dob').datepicker(

    { dateFormat: 'yy-mm-dd',

     minDate: '0', }

    );

   // Time Picker

  $('#tpBasic').timepicker(

    {



    

          });

  $('#tp2').timepicker({'scrollDefault': 'now'});

  $('#tp3').timepicker();



  $('#setTimeButton').on('click', function (){

    $('#tp3').timepicker('setTime', new Date());

  });



});

</script>



@endsection

