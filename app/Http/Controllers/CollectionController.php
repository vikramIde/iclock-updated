<?php

namespace App\Http\Controllers;
use App\Services\ViewinvoiceTrait;
use App\Services\ExchangerateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PaymentRequest;
use App\User;
use App\Invoice;
use App\comments;
use App\paymentrecieved;
use Session;
use Validator;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 use ViewinvoiceTrait;
 use ExchangerateTrait;
 
  public function __construct(){

    $this->middleware('role:collector'); // replace 'collector' with whatever role you need.
}

  public function getIndex(){

    return redirect('collection/home');   
}

  public function getHome(){

      $empid= Auth::user()->empid;
      $duetoday=array();
      $invoice = Invoice::where('Status','=',1)->orderBy('Id', 'desc')->get();
	  //$duepayment = paymentrecieved::where('dueflag','=',0)->get();
		$overduetoday = array();
		foreach($invoice as $data)
		{
			if($data->DueDate == date("Y-m-d")) {
				$duetoday[]= $data;
			}
			if($data->NxtDuedate == date("Y-m-d")) {
				$overduetoday[]= $data;
			}
		}
		
    return View('collectionmodule/home')->with(array('invoices'=>$invoice,'duetoday'=>$duetoday,'overduetoday'=>$overduetoday));
   
 }

	public function getExchange(){
				//dd('ssss');
				$amount = $this->getExchangex(23,'USD','30-10-2015');
				//dd($amount);
}

   public function getPayment($invoiceid){

         $id =	$invoiceid;                                 
         $invoice = Invoice::with(['payments', 'comments'])->where('Id', $id)->get();
		 
		 $userDetail = User::where('empid','=',$invoice[0]->RepresentativeNo)->get();
		 
		 if(count($userDetail) > 0) 
		 $salesName = $userDetail[0]->name;
			else $salesName='';
		 
         return View('collectionmodule/payment')->with(array('invoice'=>$invoice,'repName'=>$salesName));
   
 }
 
  public function saveComment($comments,$date,$invoiceid){
	  $commentmode='';
  		  $comment= new comments();
          $comment->text = ucfirst(strtolower($comments));
          $comment->date = $date;
          $comment->invoice_id = $invoiceid;
		  $comment->commentmode = $commentmode;
          $comment->save();
		
  
  }
  

  public function postAdjustment(Request $request){
	  
		$insertadjustment = Input::get();
		$payment= new paymentrecieved();
		
		
		if($insertadjustment['adjustmentmode']=='-- Select Adjust Mode --')
                $adjust_mode='NONE';
                else
                  $adjust_mode=$insertadjustment['adjustmentmode'];
	       	
				$payment->invoice_id=$insertadjustment['invoiceid'];
                $payment->date = $insertadjustment['date'];
                $payment->adjust_amount = $insertadjustment['adjustmentamount'];
                $payment->adjust_mode= $adjust_mode;
                $payment->save();
				
		$request->session()->flash('alert-success', 'Adjustment done Successfully');
		return redirect('collection/payment/'.$insertadjustment['invoiceid'].'');
  }
  
  
  public function postPayment(PaymentRequest $request){
		
		$insertPayment=Input::get();

		$data=array();

          for($i = 0; $i < count($insertPayment['recieved_amount']); $i++) {
				
				$payment= new paymentrecieved();
                if($insertPayment['adjustmentmode'][$i]=='-- Select Adjust Mode --')
                $adjust_mode='NONE';
                else
                  $adjust_mode=$insertPayment['adjustmentmode'][$i];

                $payment->invoice_id=$insertPayment['invoiceid'];
                $payment->recieved_amount = $insertPayment['recieved_amount'][$i];
                $payment->refno = $insertPayment['ref_no'][$i];
                $payment->date = $insertPayment['date'][$i];
                $payment->adjust_amount = $insertPayment['adjustmentamount'][$i];
                $payment->adjust_mode= $adjust_mode;
				$payment->dueflag = $insertPayment['dueflag'];
                $payment->save();
				
				
         }

         // $result = paymentrecieved::create($data);
		 //Save the comments 
		  $this->saveComment($insertPayment['comment'],$insertPayment['date1'],$insertPayment['invoiceid'],'P');
		  
          $request->session()->flash('alert-success', 'Payment Has Been inserted Successfully');
          return redirect('collection/payment/'.$insertPayment['invoiceid'].'');

	}
		
	public function postComment(Request $request){
			$insertcomment = Input::get();
			$this->saveComment($insertcomment['comment'],$insertcomment['date1'],$insertcomment['invoiceid']);
			
			if(!empty($insertcomment['nextduedate'])){
				$invoice = Invoice::find($insertcomment['invoiceid']);
				$invoice->NxtDuedate =$insertcomment['nextduedate'];
				//Invoice::where('Id','=',$insertcomment['invoiceid'])->update(array('NxtDuedate'=>$insertcomment['nextduedate']));
				//$invoice->NxtDuedate = $insertcomment['nextduedate'];
				$invoice->save();
				}
				$request->session()->flash('alert-success', 'Comment inserted Successfully');
				return redirect('collection/payment/'.$insertcomment['invoiceid'].'');
				//dd($insertPayment); 
	}
        

  public function getViewinvoice($order_id){

     $data = $this->getInvoicex($order_id);

    $id=$order_id;

    $invoicedata=Invoice::where('Id',$id)->get();


    $html22 =  View('viewinvoice')->with(array('invoicedata'=>$invoicedata ))->render();

    require_once(app_path().'/libs/html2pdf/html2pdf.class.php');


    $html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

    // $html2pdf->pdf->SetDisplayMode('fullpage');

    $html2pdf->WriteHTML($html22);

    $html2pdf->Output('Invoice.pdf');
        
      
    }
 }
