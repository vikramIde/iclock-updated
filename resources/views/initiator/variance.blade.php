@extends('app')

@section('content')

<section>
 @foreach($emp as $en)

<input type="hidden" name="emp_id"  autocomplete="off" value="{{$en->emp_ide_id}}|{{$en->emp_name}}">
<input type="hidden" name="empdept"  autocomplete="off" value="{{$en->emp_department}}">
@endforeach
 <?php $Targetvalue= $dealDate=0 ; ?> 
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
          <li class="nav-parent ">
              <a href=""><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a>
             
             <ul class="children">
                <li ><a href="{{ URL::to('initiator/leadsheet')}}"><i class="fa fa-line-chart"></i><span> Lead Sheet</span></a></li>
                   <li><a href="{{ URL::to('initiator/pendingforfollowup')}}"><i class="fa fa-line-chart"></i><span> Pending for Follow up</span></a></li>
               <li ><a href="{{ URL::to('initiator/callbackassigned')}}"><i class="fa fa-line-chart"></i><span> Call Backs </span></a></li>
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
               <li class="nav-parent active">
              <a href=""><i class="fa fa-line-chart"></i><span> Variance Card</span></a>
             
             <ul class="children">
                <li class="active"><a href="{{ URL::to('initiator/variancecard')}}"><i class="fa fa-line-chart"></i><span> Variance Card</span></a></li>
            
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
        <li class="active">Variance</li>
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
              <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Variance Card</strong></a></li>
           
            
          </ul>
           <div class="tab-content mb20">
            <div class="tab-pane active" id="popular5">
               <form id="vcard" action="variancecard" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                                            <input type='hidden' class="datepicker" id='startDate' value="<?php echo $targetdate ?>" />
                                            <input type='hidden' class="datepicker" id='endDate' value="<?php echo $eventdate ?>" />
                                            <table id="dataTable3" class="table table-bordered table-striped-col">
                                                <tr><td>Event Name</td>
                                                    <td>
                                                      <select class="form-control" name="event">
                                                            @foreach($target as $tag)
                                                            <?php $empid = $tag->Employeeid ?>
                                                            <option value="{{$tag->Eventname}}">{{$tag->Eventname}}</option>
                                                           @endforeach
                                                        </select>
                                                   </td>
                                                    <td>
                                                      <input type="hidden" name="empid" value="<?php $empid=0;echo $empid ?>" />
                                                      <button type="submit" class="getvariance btn btn-primary " name="submit">Submit</button>
                                                    </td>

                                                </tr>
                                            </table>
                                           
                                              </form>

            </div>
          </div>

         
         </div>

      </div><!-- row-->
@foreach($variancedata as $varidata)
   <?php $Targetvalue= $varidata->Targetvalue ?>
      <div class="row" >
        <div class="col-md-9 col-lg-8 dash-left" id="p_box_1">
         

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
                    <h4 class="panel-title">Target Value</h4>
                   <p>&nbsp;</p>
                    <h5 class="text-success">{{$varidata->Targetvalue}}</h5>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-calendar"></div>
                  </div>
                  <h4 class="panel-title">Currency</h4>
                  <!-- <h3>38.10</h3> --><p>&nbsp;</p>
                  <h5 class="text-success">{{$varidata->Currency}}</h5>
                </div>
           
             
              
                <div class="col-xs-6 col-sm-4">
                  <div class="pull-left">
                    <div class="icon icon ion-person"></div>
                  </div>
                  <h4 class="panel-title">Achieved</h4>
                  <!-- <h3>4:45</h3> --><p>&nbsp;</p>
                  <h5 class="text-success">@foreach($userdata as $val)
                                                             {{$val['achieved']}}
                                                            @endforeach</h5>
                </div>
                
              <div class="mb20"></div>

            

            </div><!-- panel-body -->

           

          </div><!-- panel -->
    


        </div><!-- col-md-9 -->
         <div class="col-md-3 col-lg-3">

          <div class="panel panel-site-traffic">
            <div class="panel-heading">
              <ul class="panel-options">
                <li><a><i class="fa fa-refresh"></i></a></li>
              </ul>
              <h4 class="panel-title text-success">Target Dates</h4>
             <!--  <p class="nomargin">Past 30 Days — Last Updated July 14, 2015</p> -->
            </div>
            <div class="panel-body">
            
                <div class="col-xs-6 ">
                  <h4 class="today-day">START</h4></br></br>
                      <h5 class="today-date"><?php $targetdate;
                      $time=strtotime($targetdate);
                       $date=date("d",$time);
                       $month=date("F",$time);
                       $year=date("Y",$time);
                      echo $month ; echo "&nbsp"; echo $date; echo ","; echo $year;
                       ?></h5>
                      
                </div>
                <div class="col-xs-6">
                   <h4 class="today-day">END</h4></br></br>
                      <h5 class="today-date"> <?php  $eventdate;
                      $time=strtotime($eventdate);
                       $date=date("d",$time);
                       $month=date("F",$time);
                       $year=date("Y",$time);
                      echo $month ; echo "&nbsp"; echo $date; echo ","; echo $year; ?></h5>
                </div>
              </div>
            </div>
           
            </div>
       <!-- col-md-3 -->
      </div><!-- row -->
                             
     <div class="row ">
      <div class="col-md-2">
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Category</h4>
             
            </div>
            <div class="panel-body paddingtop10">
              <div class="btn-demo">
                
                <button class="btn btn-primary" id="test" >Weekly</button>
              </div>
              <div class="btn-demo">
                
                <button class="btn btn-primary" id="test1">Monthly</button>
              </div>
              <div class="btn-demo">
               
                <button class="btn btn-primary" id="test2" >Daily</button>
              </div>
            
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-md-4 -->

        <div class="col-md-10">
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Graph Report</h4>
             
            </div>
            <div class="panel-body paddingtop10">
          <div id="graph"></div>
            
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-md-4 -->

     </div>
     <div class="row">
       <div class="col-md-12 ">
          <div class="panel">
            <div class="panel-heading">
              <h4 class="panel-title">Table Report </h4>
             
            </div>
            <div class="panel-body">
            <div class="weekly">
               <div class="table-responsive">
               </div>
            </div>
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-md-4 -->
     </div>
	  <script type="text/javascript">

         $(document).ready(function() {
            var month = [31,28,31, 30, 31,30,31,31,30,31,30,31];
                
                //month[12] = 30;
              
          function makeGraph(title ,x_axis,Target,Achieved ){
                      $('#graph').highcharts({
                      chart: {
                          type: 'line'
                      },
                      title: {
                          text: title
                      },
                      subtitle: {
                          text: 'Source: ide-global.com'
                      },
                      xAxis: {
                          categories: x_axis
                      },
                      yAxis: {
                          title: {
                              text: 'Money'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: true
                              },
                              enableMouseTracking: false
                          }
                      },
                      series: [{
                          name: 'Target :'+Target[0],
                          data: Target
                      }, {
                          name: 'Achieved',
                          data: Achieved
                      }]
                  });
           
               }

           // Here are the two dates to compare
              var date1 = '<?php echo $targetdate ?>';
              var date2 = '<?php echo $eventdate ?>';
              var Targetvalue = parseFloat("<?php echo $Targetvalue ;?>");
              var dealjson = '<?php echo $dealjson ; ?>';
                

              // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
              date1 = date1.split('-');
              date2 = date2.split('-');

              // Now we convert the array to a Date object, which has several helpful methods
              date1 = new Date(date1[0], date1[1]-1, date1[2]);
              date2 = new Date(date2[0], date2[1]-1, date2[2]);
              var deals = JSON.parse(dealjson);
              
              // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
              date1_unixtime = parseInt(date1.getTime() / 1000);
              date2_unixtime = parseInt(date2.getTime() / 1000);

              // This is the calculated difference in seconds
              var timeDifference = date2_unixtime - date1_unixtime;
              // in Hours
              var timeDifferenceInHours = timeDifference / 60 / 60;

              // and finaly, in days :)
              var timeDifferenceInDays = timeDifferenceInHours / 24;
              var timeDifferenceInWeeks = Math.round(timeDifferenceInDays / 7);
              var timeDifferenceInMonths = Math.round(timeDifferenceInDays / 30);

              // alert(timeDifferenceInDays/7);
              TargetPerweek = Targetvalue / timeDifferenceInWeeks;
              TargetPerday = Math.round((Targetvalue / timeDifferenceInDays)*100)/100;

              //Math.round(timeDifferenceInWeeks);
              TargetPerweek = Math.round(TargetPerweek * 100) / 100;
              TargetPerMonth = Math.round((Targetvalue/timeDifferenceInMonths)*100/100)
              
        /**$('#test, #test2').click(function(){

            $('html,body').animate({
                scrollTop: $('.graph').offset().top
            }, 1000);

            return false;
        });**/

        $('#test').click(function () {

              date1_week= date1;
              date2_week= date2;
              var x_axis = [];
              var Target =[];
              var Achieved = [];
              var str = '<table id="dataTable2" class="table table-bordered table-striped-col"> <thead ><tr> <th>Week</th> <th>Date</th><th>Target</th> <th>Achieved</th> </tr></thead>';

              var i = 0;
              var achieved = 0;
              while (date1_week <= date2_week) {

                  var next_week = new Date(date1_week);
                  next_week.setDate(date1_week.getDate() + 7);
                  achieved = 0;

                  deals.forEach(function (deal) {
                      var dealDate = deal.dealdate;
                      dealDate = dealDate.split('-');
                      dealDate = new Date(dealDate[0], dealDate[1]-1, dealDate[2]);
                      if (dealDate >= date1_week && dealDate <= next_week) {
                          achieved = achieved + deal.cost;
                      }
                  });

                  i = i + 1;
                  mWeek = "Week "+ i ;
                  x_axis.push(mWeek);Target.push(TargetPerweek);Achieved.push(achieved);
                  str = str + "<tr><td>"+ mWeek +"</td><td>"+date1_week.getDate()+"-"+(date1_week.getMonth()+1)+"-"+date1_week.getFullYear()+" - "+next_week.getDate()+"-"+(next_week.getUTCMonth()+1)+"-"+next_week.getFullYear()+"</td><td style='text-align:right'>" + TargetPerweek + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
                  date1_week = next_week;  
              }

              str = str + "</table>";
             makeGraph('Weekly Event Sale Report',x_axis,Target,Achieved );
              $('.weekly').html(str);
             
           
        });

        $('#test1').click(function () {

              date1_month= date1;
              date2_month= date2;

              var str1 = '<table id="dataTable1" class="table table-bordered table-striped-col"> <thead><tr> <th>Month</th> <th>Date</th><th>Target</th> <th>Achieved</th> </tr></thead>';

              var i = 0;
              var achieved = 0;
              var x_axis = [];
              var Target = [];
              var Achieved = [];

              while (date1_month <= date2_month) {
                  var next_month = new Date(date1_month);
                  next_month.setDate(date1_month.getDate() + 30 );

                  achieved = 0;

                  deals.forEach(function (deal) {
                      var dealDate = deal.dealdate;
                      dealDate = dealDate.split('-');
                      dealDate = new Date(dealDate[0], dealDate[1]-1, dealDate[2]);
                      if (dealDate >= date1_month && dealDate <= next_month)  {
                          achieved = achieved + deal.cost;
                      }
                  });
                  i = i + 1;
                  mDay = "Month " + i;
                  x_axis.push(mDay);
                  Target.push(TargetPerMonth);
                  Achieved.push(achieved);
                  str1 = str1 + "<tr><td>"+ mDay +"</td><td>"+date1_month.getDate()+"-"+(date1_month.getMonth()+1)+"-"+date1_month.getFullYear()+" - "+next_month.getDate()+"-"+(next_month.getUTCMonth()+1)+"-"+next_month.getFullYear()+"</td><td style='text-align:right'>" + TargetPerMonth + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
                  date1_month = next_month;
              }

              str1 = str1 + "</table>";
              makeGraph('Monthly Event Sale Report', x_axis, Target, Achieved);

              $('.weekly').html(str1);
             

        });
 
$('#test2').click(function () {

    date1_day = date1;
    date2_day = date2;
    var x_axis = [];
    var Target = [];
    var Achieved = [];

    var str1 = '<table  id="dataTable3" class="table table-bordered table-striped-col"> <thead ><tr> <th>Week</th> <th>Date</th><th>Target</th> <th>Achieved</th> </tr></thead>';

    var i = 0;
    var achieved = 0;
    while (date1_day <= date2_day) {
        var next_week = new Date(date1_day);
        next_week.setDate(date1_day.getDate() + 1);
        achieved = 0;
        deals.forEach(function (deal) {
            var dealDate = deal.dealdate;
            dealDate = dealDate.split('-');
            dealDate = new Date(dealDate[0], dealDate[1] - 1, dealDate[2]);
            if (dealDate.getTime() === date1_day.getTime()) {
                achieved = achieved + deal.cost;
            }
        });
        i = i + 1;
        mDay = "Day " + i;
        x_axis.push(mDay);
        Target.push(TargetPerday);
        Achieved.push(achieved);
        str1 = str1 + "<tr><th>Day " + i + "</th><td>" + date1_day.getDate() + "-" + (date1_day.getMonth() + 1) + "-" + date1_day.getFullYear() + "</td><td style='text-align:right'>" + TargetPerday + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
        date1_day = next_week;
    }

    str1 = str1 + "</table>";
    makeGraph('Daily Event Sale Report', x_axis, Target, Achieved);
    $('.weekly').html(str1);
    

});

             $('.datepicker').datepicker();
               

                $('.dob').datepicker({
                    format: 'dd-mm-yyyy',
                    startDate: '-0m',
                    autoclose: true

                });

                $('.dp').on('change', function() {
                    $('.datepicker').hide();
                });


            });

/**$(document).ready(function() {

  'use strict';

 /* $('#dataTable1').DataTable();
  $('#dataTable2').DataTable();
  $('#dataTable3').DataTable();
  // Select2
  $('select').select2({ minimumResultsForSearch: Infinity });)*/

/**});**/


         </script>
     @endforeach

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>


     

@endsection
