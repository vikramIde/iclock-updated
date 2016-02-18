@extends('app')



@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea#spnotes' });</script>
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

                <li class="active"><a  href="{{ URL::to('executor/home') }}" ><i class="fa fa-home"></i><span> Dashboard</span></a></li>

            

              </ul>

            </li>

            

            <li class="nav-parent active">

              <a  href=""><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>

             <ul class="children">

                <li class="active"><a  href="{{URL::to('executor/dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a></li>

            

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



      <ol class="breadcrumb breadcrumb-quirk">

        <li><a ><i class="fa fa-home mr5"></i> Home</a></li>

        <li><a >Dashbord</a></li>

        <li class="active">Page1</li>

      </ol>



     



      <div class="row">



             <div class="col-md-12">



         

          <!-- Nav tabs -->

          <ul class="nav nav-tabs nav-primary">

            <li class="active"><a href="#popular5" data-toggle="tab"><strong>Create Invoice</strong></a></li>

          

            

          </ul>



          <!-- Tab panes -->

          <div class="tab-content mb20">

            <div class="tab-pane active" id="popular5">



                <?php

                   foreach($invoicedata as $data){

                    ?>

                                       



                <form action="{{ url('executor/invoice') }}" method="post" enctype="multipart/form-data">

                                                        <input type="hidden" name="dealid" value="<?php echo $data->Id ?>">



                                                            <fieldset>



                                                                <div id="wrapper">

                                                                    <h2 style="text-align:center; font-weight:bold;">PROFORMA INVOICE</h2>

                                                                    <br>

                                                                    <table class="heading table table-bordered">

                                                                        <tbody>

                                                                            <tr>

                                                                                <td>

                                                                                    <b>Client Information</b> <span class="required">*</span>

                                                                                    <br>

                                                                                    <table class="table table-bordered">

                                                                                        <tbody>

                                                                                            <tr>

                                                                                                <td class="value">

                                                                                                    <textarea class="form-control" name="client_address"><?php echo $data->billingadd?></textarea>

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td class="value">Kind Attention:

                                                                                                    <input type="text" name="client_name" value="<?php echo $data->Clientname?>" autocomplete="off" placeholder="Name" class="form-control">

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td class="value">Company Name: 

                                                                                                    <input type="text" name="companyname" value="<?php echo $data->Companyname?>" autocomplete="off" placeholder="Name" class="form-control">

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td class="value">Email Address:
                                                                                                  <?php

    
    $email ="";
    $xx=0;
    // dd(count($invoicemails));
     foreach($invoicemails as $mail){
      $xx++;
        $email .=$mail['email'];

        if($xx <= count($invoicemails)-1)
          $email.=",";

       
      }
    ?>
    
     <textarea class="form-control" name="client_email"><?php   echo  $email;  ?></textarea>
     

                                                                                             
                                                                                                </td>

                                                                                            </tr>

                                                                                        </tbody>

                                                                                    </table>

                                                                                    <div id="divCustomerInfo"></div>

                                                                                </td>

                                                                                <td valign="top" align="right" style="padding:3mm;">

                                                                                    <table class="table table-bordered" style="height:auto; margin-top:30px">

                                                                                        <tbody>



                                                                                            <tr>

                                                                                                <td>Rep No </td>

                                                                                                <td>

                                                                                                    <select name="rep_id" class="form-control">



                                                                                                                    <?php 

                                                                                            foreach($employee as $e){

                                                                                              ?>

                                                                                            <option value="<?php echo $e->emp_ide_id ?>|<?php echo $e->emp_name ?>" <?php if($data->Empid==$e->emp_ide_id) echo "selected";?>>

                                                                                              <?php echo $e->emp_name ?>

                                                                                            </option>



                                                                                            

                                                                                         <?php

                                                                                     }

                                                                                     ?>



                                                                                                

                                                                                                    </select>

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td>Proforma Invioce Date : </td>

                                                                                                <td>

                                                                                                    <input id="dob" autocomplete="off" name="invoice_date" class="form-control dob" type="text">

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td>Due Date </td>

                                                                                                <td>

                                                                                                    <input id="dob1" autocomplete="off" name="due_date" class="form-control dob" type="text">

                                                                                                </td>

                                                                                            </tr>

                                                                                            <tr>

                                                                                                <td>Particular </td>

                                                                                                <td>

                                                                                                    <select name="purpose" class="form-control particular">

                                                                                                        <!-- <option>Choose</option>

                                                                                                        <option value="annual">Annual</option>

                                                                                                        <option value="single">Single</option> -->

                                                                                                          <option value="{{$data->Dealtype}}">{{$data->Dealtype}}</option>



                                                                                                    </select>

                                                                                                </td>

                                                                                            </tr>

                                                                                        </tbody>

                                                                                    </table>

                                                                                </td>

                                                                            </tr>

                                                                        </tbody>

                                                                    </table>

                                                                    <div id="content">

                                                                        <div id="invoice_body">

                                                                            <table id="main-data-table" class="order-list table table-bordered">

                                                                                <thead>

                                                                                    <tr style="background:#eee;">

                                                                                        <td><b>S.no</b></td>

                                                                                        <td class="w15"><b>Particulars</b></td>

                                                                                        <td class="w15"><b>Currency</b></td>

                                                                                        <td style="width:20%;"><b>Amount</b></td>

                                                                                    </tr>

                                                                                </thead>

                                                                                <tbody class="inputs">

                                                                                    <tr class="valuesinv annual report">

                                                                                        <td class="mono w10">

                                                                                            <input placeholder="" style="width:80px" autocomplete="off" name="s_no_anuual1" class="form-control" type="text">

                                                                                        </td>

                                                                                        <td class="mono w15">

                                                                                            <input id="" name="anuual_text" autocomplete="off" class="form-control" type="text">

                                                                                        </td>

                                                                                        <td class="mono w15">

                                                                                            <select name="annual_currency1" class="form-control ">

                                                                                                <!-- <option value="select">Select</option>

                                                                                                <option value="INR">INR</option>

                                                                                                <option value="EURO">EURO</option>

                                                                                                <option value="DOLLAR">DOLLAR</option> -->

                                                                                                <option value="{{$data->Dealcurr}}">{{$data->Dealcurr}}</option>



                                                                                            </select>

                                                                                        </td>

                                                                                        <td class="mono w10">

                                                                                          <?php if($data->Dealtype=='annual'){?>

                                                                                            <input type="text" autocomplete="off" name="annual_amount1" value="<?php echo $data->Dealvalue?>" class="form-control">



                                                                                          <?php

                                                                                        }else{?>

                                                                                          <input type="text" autocomplete="off" name="annual_amount1" class="form-control">

                                                                                          <?php



                                                                                          }

                                                                                          ?>

                                                                                            

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr class="valuesinv annual single report">

                                                                                        <td class="mono w10">

                                                                                            <input placeholder="" autocomplete="off" style="width:80px" id="" name="s_no" class="form-control" type="text">

                                                                                        </td>

                                                                                        <td class="mono w15">

                                                                                          <select name="event_name" class="form-control">

                                                                                         

                                                                                            

                                                                                              <option value="{{$data->Eventcode}}|{{$data->Eventname}}">{{$data->Eventname}}</option>

                                                                                              



                                                                                            </select>

                                                                                           <input type="hidden" name="eventcode" value="{{$data->Eventcode}}">

                                                                                        </td>

                                                                                        <td class="mono w15">

                                                                                            <select name="currency_type" id="currency" class="form-control currency">

                                                                                                

                                                                                            <option value="{{$data->Dealcurr}}">{{$data->Dealcurr}}</option>

                                                                                            <?php  $curr = $data->Dealcurr?>

                                                                                            </select>

                                                                                        </td>

                                                                                        <td class="mono w10">

                                                                                          <?php if($data->Dealtype=='single'){

                                                                                               $dealtype ='single';

                                                                                            ?>

                                                                                            <input type="text" name="amount" id="amount" autocomplete="off" value="<?php echo $amount = $data->Dealvalue?>" class="form-control" />



                                                                                          <?php

                                                                                        }else{

                                                                                             $dealtype ='annual';

                                                                                          ?>

                                                                                          <input type="text" name="amount" id="amount" autocomplete="off" value="" class="form-control" />

                                                                                          <?php



                                                                                          }

                                                                                          ?>

                                                                                           

                                                                                        </td>

                                                                                    </tr>

                                                                                   

                                                                                     <tr class="valuesinv">

                                                                                        <td class="mono w10"></td>

                                                                                        <td class="mono w15"></td>

                                                                                        <td class="mono w15">Sub Total [a]</td>

                                                                                        <td class="mono w10">

                                                                                            <input type="text" autocomplete="off" id="subtotal" autocomplete="off"  name="sub_total" class="form-control">

                                                                                        </td>

                                                                                    </tr>

                                                                                    

                                                                                    <tr class="valuesinv INR price">

                                                                                        <td class="mono w10"></td>

                                                                                        <td class="mono w15">Service Tax @</td>

                                                                                        <td class="mono w15">

                                                                                            <select name="service_tax" id="tax" class="form-control">

          

                                                                                            <option value="14">14%</option>

                                                                                                  </select>

                                                                                        </td>

                                                                                        <td class="mono w10">

                                                                                            <input type="text" name="service_tax_amount" autocomplete="off" id="tax_amount"class="form-control"  />

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr class="valuesinv INR price">

                                                                                        <td class="mono w10"></td>

                                                                                        <td class="mono w15"> Swachh Bharat Cess @ </td>

                                                                                        <td class="mono w15">

                                                                                            <select name="swachtax" id="swach_tax" class="form-control">

          

                                                                                            <option value="0.5">0.5%</option>

                                                                                                  </select>

                                                                                        </td>

                                                                                        <td class="mono w10">

                                                                                            <input type="text" name="swachtaxamount" autocomplete="off" id="swachtax"class="form-control"  />

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr class="valuesinv swach">

                                                                                        <td class="mono w10"></td>

                                                                                        <td class="mono w15"></td>

                                                                                        <td class="mono w15">Sub Total [b]</td>

                                                                                        <td class="mono w10">

                                                                                           <input type="text" name="subtotalb" id="SubTotal"  autocomplete="off"  class="form-control"  />

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr class="valuesinv">

                                                                                        <td class="mono w10"></td>

                                                                                        <td class="mono w15"></td>

                                                                                        <td class="mono w15">Grand Total</td>

                                                                                        <td class="mono w10">

                                                                                           <input type="text" name="grand_total" id="total_amount"  autocomplete="off"  class="form-control"  />

                                                                                        </td>

                                                                                    </tr>

                                                                            </table>

                                                                            <table class="table table-bordered">

                                                                                <tbody>

                                                                                    <tr>

                                                                                        <td class="pis-btm-left" valign="top" colspan="4">

                                                                                            Amount in Words :

                                                                                            <input type="text" autocomplete="off" id="divDisplayWords" name="amount_in_words" class="form-control">



                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="pis-btm-left" valign="top" colspan="4">

                                                                                            Payment Terms:

                                                                                            <br>

                                                                                            <textarea rows="4" name="payment_interms" id="spnotes" class="form-control"></textarea>

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="pis-btm-left" valign="top" colspan="4">

                                                                                            PAN NO: AACCI9411N

                                                                                            <br> Company No: U74900KA2012PTC064066

                                                                                            <br> Service Tax Reg No : AACCI9411NSD001 </br>

                                                                                            Service Tax Registration Category: Promotion or marketing of brand of goods/services/events Service </td>

                                                                                    </tr>



                                                                                </tbody>

                                                                            </table>

                                                                            <table class="table table-bordered">

                                                                                <tbody>

                                                                                    <tr>

                                                                                        <td class="pis-btm-left" valign="top" colspan="4">

                                                                                            <b>Bank Details</b> </br>

                                                                                            </br>

                                                                                            <b>Beneficiary</b> : IDE Consulting Services  Private Limited

                                                                                            <br> <b>Bank </b>: Axis Bank

                                                                                            <br>

                                                                                            <?php

                                                                                           $value=$data->Dealcurr;

                                                                                       if($value=='USD'){

                                                                                        ?>

                                                                                         <b>Account No </b>: 9130 2001 9488 261<br>



                                                                                        <?php

                                                                                      }else  if($value=='INR'){ ?>

                                                                                       <b>Account No </b>: 9130 2000 8276 686<br>



                                                                                     <?php 

                                                                                      }else {?>

                                                                                      <b>Account No </b>: 9130 2003 5144 859<br>



                                                                                      <?php }



                                                                                            ?>

                                                                                             </td>

                                                                                        <td class="pis-btm-right" valign="top" colspan="4">

                                                                                            </br>

                                                                                            </br>

                                                                                            SWIFT : AXISINBB227

                                                                                            <br> RTGS / NEFT: UTIB0000227 </td>

                                                                                    </tr>

                                                                                </tbody>

                                                                            </table>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </fieldset>



 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                                            <input type="submit" name="submit" value="Save & Send for Approval" class="btn btn-primary ">



                                                        </form>

                                                        <?php

}

?>

                                                    





            </div>

   

            

              

        </div><!-- col-md-6 -->



      </div><!-- row-->



    </div><!-- contentpanel -->



  </div><!-- mainpanel -->

</section>



 <script type="text/javascript">





      

           

              var calcObject = {

 

    run : function() {

      <?php if($dealtype=="single") {?>

    var amount = <?php echo $amount ; ?> 

    <?php } else { ?>

        var amount = $('#amount').val();

    <?php 

    } ?>



    var currency=$('#currency').val();

    var tax  = $('#tax').val();

    var swach_tax=$('#swach_tax').val();

    var subtotal  = $('#subtotal').val();

    

   

    if (amount !== '' && tax !== '' && currency =='INR') {

      

        calcObject.amountTax = (amount * tax) / 100;

         calcObject.amountSwachTax = (amount * swach_tax) / 100;

        calcObject.subTotal = parseFloat(amount) ;

        calcObject.amountTotal = parseFloat(amount) + parseFloat(calcObject.amountTax) +parseFloat(calcObject.amountSwachTax);

        calcObject.amountSubTotal =parseFloat(calcObject.amountTax) +parseFloat(calcObject.amountSwachTax);

       

     

      $('#tax_amount').val(parseFloat(calcObject.amountTax).toFixed(2));

       $('#swachtax').val(parseFloat(calcObject.amountSwachTax).toFixed(2));

         $('#SubTotal').val(parseFloat(calcObject.amountSubTotal).toFixed(2));

      $('#total_amount').val(parseFloat(calcObject.amountTotal).toFixed(2));

      inWords(calcObject.amountTotal);

       $('#subtotal').val(parseFloat(calcObject.subTotal).toFixed(2));

      

    } else if (amount !== '' && tax !== '') {

      calcObject.amountTax =amount;

        calcObject.amountTotal = parseFloat(amount) ;

         calcObject.subTotal = parseFloat(amount) ;

       

     

      $('#tax_amount').val(parseFloat(calcObject.amountTax).toFixed(2));

      $('#total_amount').val(parseFloat(calcObject.amountTotal).toFixed(2));



      inWords(calcObject.amountTotal);



      $('#subtotal').val(parseFloat(calcObject.subTotal).toFixed(2));

       

    }

    else{

      $('#tax_amount').val(calcObject.amountNull);

      $('#total_amount').val(calcObject.amountNull);

    }

  }

};



var a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen '];

var b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];



function inWords(num) {

    if ((num = num.toString()).length > 9) return 'overflow';

    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);

    if (!n) return;

    var str = '';

    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';

    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';

    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';

    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';



    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';

    $('#divDisplayWords').val(str);

   

}



$(function() {



<?php if($dealtype=="single") {?>

    calcObject.run();

    <?php } else { ?>

       $('#amount').keyup(function() {

    calcObject.run();

  });

    <?php 

    } ?>



  $('#currency').click(function() {

    calcObject.run();

  });

  

  $('#tax').change(function() {

    calcObject.run();

  });

$('#subtotal').change(function() {

    calcObject.run();

  });



});

        </script>

      





        <script type="text/javascript">

            $(document).ready(function() {

                $("select.particular").change(function() {

                    $(this).find("option:selected").each(function() {

                        if ($(this).attr("value") == "annual") {

                            $(".report").not(".annual").hide();

                            $(".annual").show();



                        } else if ($(this).attr("value") == "single") {

                            $(".report").not(".single").hide();

                            $(".single").show();

                         

                        } else {

                            $(".report").hide();

                        }

                    });

                }).change();

            });

            $(document).ready(function() {

                $("select.currency").change(function() {

                    $(this).find("option:selected").each(function() {

                        if ($(this).attr("value") == "INR") {

                            $(".price").not(".INR").hide();

                            $(".INR").show();

                        } else {

                            $(".price").hide();

                              $(".swach").hide();

                        }

                    });

                }).change();

            });

        </script>

<script>



$(document).ready(function() {



  'use strict';



    $('#dataTable1').DataTable();

    $('#dataTable2').DataTable();

 

$('.dob').datepicker(

  {

 dateFormat: 'yy-mm-dd',

       

}

  );

  $('#datepicker-inline').datepicker();

  $('#datepicker-multiple').datepicker({ numberOfMonths: 2 });

});

</script>



@endsection

