<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ViewinvoiceTrait;
use App\Services\ExchangerateTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EventRequest;
use App\invoiceemails;
use App\Event;
use App\Employee;
use App\Invoice;
use App\Deal;
use Mail;
use DB;
use View;

class ExecutorController extends Controller
{

  use ViewinvoiceTrait;
  use ExchangerateTrait;
  
  public function __construct(){

    $this->middleware('role:admin1'); // replace 'collector' with whatever role you need.
}
   
public function getIndex(){
                
            return redirect('executor/home');
 }


public function getHome(){
                $year= date("Y"); 
                $categories = Event::where( DB::raw('year(date)'), $year)->get();
                $employee = Employee::all();
               
               // dd($year);
                $invoice = Invoice::orderBy('Id', 'DESC')->where( DB::raw('year(InvoiceDate)'), $year)->where( DB::raw('year(DueDate)'), $year)->get();

                return View('executor/home')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice));
 }
public function getExchange(){
				$this->getExchangex(23,'USD','30-10-2015');
}

public function postEvent( EventRequest $request ) {
		
			$data = Input::get();

			for($i = 0; $i < count($data['eventname']); $i++) {
				$c= new Event();

				$c->event = $data['eventname'][$i];
				$c->eventcode = $data['eventcode'][$i];
				$c->date = $data['date'][$i];
				$c->city = $data['city'][$i];
				$c->country  = $data['country'][$i];
				$c->save();
			     
			 }
			
		      $request->session()->flash('alert-success', 'Event was successful added!');
		      return redirect('executor/home');
    
    
}

public function postUpdateemployee( Request $request) {
	
			$emp_id_d=Input::get('emp_id_d');

			$post = Input::get();
			$i=Employee::where('emp_id',$emp_id_d)
			->update(array(
			'emp_name' => $post['emp_name'],
			'emp_ide_id' => $post['emp_id'],'emp_status' => $post['emp_status'],
			'emp_department' => $post['emp_dept'])
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/home');

			}

    
}

public function postUpdateinvoice( Request $request) {

			$evnid=Input::get('view_invoice');
			$inv_status=Input::get('invoice_status');

			if($inv_status=='Attended with Modification'){
			$invoice_data=Invoice::where('Id',$evnid)->get();
			$cate = Event::all();
			$employee = Employee::all();
			return view('executor/invoice_edit')->with(array('invoice_data'=>$invoice_data,'cate' =>$cate , 'employee'=>$employee));


			}
			if($inv_status=='Attended without modification'){
			// $post = Input::get();
			$i=Invoice::where('Id',$evnid)
			->update(array(
			'Invoice_status' =>  $inv_status
			)
			);
			if($i>0){
				$request->session()->flash('alert-success', 'Updated Success!');
				return redirect('executor/home');

			}

			}
			if($inv_status=='Not Attended'){
			// $post = Input::get();
			$i=Invoice::where('Id',$evnid)
			->update(array(
			'Invoice_status' => $inv_status
			)
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/home');

			}

			}
			if($inv_status=='Entitlement'){

			}
			if($inv_status=='Deal Cancel'){

				$dealstatus='Request Cancel';

			$invoice_data=Invoice::where('Id',$evnid)->get();
			foreach($invoice_data as $data){
				$dealid=$data->dealid;
			}
			$dealdata=Deal::where('Id',$dealid)->get();
			foreach($dealdata as $ddeal){
				$dealempid=$ddeal->Id;

			}
			// dd($dealempid);

			$i=Invoice::where('Id',$evnid)
			->update(array(
			'Status' => $dealstatus
			)
			);

			
			$i=Deal::where('Id',$dealempid)
			->update(array(
			'Status' => $dealstatus
			)
			);

			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/home');

			}

			



			}

}

public function postEventupdate( Request $request) {

			$evnid=Input::get('even_id');

			$post = Input::get();
			$i=Event::where('id',$evnid)
			->update(array(
			'event' => $post['eventname'],
			'city' => $post['eventcity'],
			'country'=>$post['eventcountry'],
			'date' => $post['eventdate'])
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/home');

			}

    
}

public function postDelevent( Request $request) {

			$evn_del=Input::get('evn_del_id');

			$i=Event::where('id',$evn_del)->delete();

			if($i>0){
			  $request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/home');

			}

    
}

public function getViewinvoice($order_id){

		 $data = $this->getInvoicex($order_id);
    }

  public function getDealsclosed(){

		$categories = Deal::where('Status','=',1)->where('Dealvalue','!=','0')->get();
		$dealcan = Deal::where('Status','=','cancelled')->get();

		$in=Invoice::all();

		return View('executor/dealsclosed')->with(array('categories'=>$categories,'in'=>$in,'dealcan'=>$dealcan));
  }

  public function getCreateinvoice($dealid) {

		$id=$dealid;

		$invoicedata=Deal::where('Id',$id)->get();
		// dd($invoicedata);
		foreach ($invoicedata as $dat) {
		# code...
		$evname=$dat['Eventname'];
		}
		$invoicemails=invoiceemails::where('deal_id',$id)->where('invoicemark','=','Y')->get();
		$invemail = $invoicemails->toArray();
		$categories = Event::where('event',$evname)->get();

		foreach($categories as $category){
		$EventDate = $category['date'];
		}
		$employee = Employee::all();
		$invoice = Invoice::all();
		return View('executor/createinvoice')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice,'invoicedata'=>$invoicedata ,'EventDate'=> $EventDate,'invoicemails'=>$invoicemails));
     
 }

 public function postInvoice( Request $request ) {
		  $dealid=Input::get('dealid');
		 
		$variable=Input::get('purpose');
		$evname=Input::get('event_name');
		$result=(explode('|', $evname, 2));
		$evcode=trim($result[0]);
		$eventname=trim($result[1]);

		$inv='IDE';
		$nameofinvoice='PROFORMA INVOICE';

		$dateValue=date('d-m-Y');
		$time=strtotime($dateValue);
		$year=date("Y",$time);

		$count = Invoice::all()->count();
		$counti = str_pad($count, 3, '0', STR_PAD_LEFT);
		$invoicecode=$inv.'-'.''.$evcode.'-'.' '.$year.$counti;
		

		$varr='NULL';
		$st='Invoice Created';
		$dealstatus='0';

		$repnamecode=Input::get('rep_id');
		$result=(explode('|', $repnamecode, 2));
		$empid=trim($result[0]);
		$empname=trim($result[1]);
		// dd($empname);

		$ydate=date('Y-m-d',strtotime("-1 days"));
		// dd($ydate);
		if(Input::get('currency_type')!='INR'){

			$exchnagerate = $this->getExchangex( Input::get('amount'), Input::get('currency_type'),$ydate);

		}
		else{

			$exchnagerate=Input::get('amount');

		}


		if($variable=='annual'){
		$c= new Invoice();
		 $c->Particulars=Input::get('purpose');
		$c->CientAddress=Input::get('client_address');
		$c->ClientName=Input::get('client_name');
		$c->Companyname=Input::get('companyname');
		$c->ClientEmail=Input::get('client_email');

		$c->RepresentativeNo=$empid;
		$c->Repname=$empname;
		$c->InvoiceDate=Input::get('invoice_date');
		$c->DueDate=Input::get('due_date');

		$c->AnnualSerialNo=Input::get('s_no_anuual1');
		$c->AnnualText=Input::get('anuual_text');
		$c->AnnualCurrencyType=Input::get('annual_currency1');
		$c->AnnualAmount=Input::get('annual_amount1');
		$c->SerialNo=Input::get('s_no');
		$c->Eventcode=Input::get('eventcode');
		$c->EventName=$eventname;
		$c->CurrencyType=Input::get('currency_type');
		$c->Amount=Input::get('amount');
		$c->Rcvalue=$exchnagerate ;
		$c->GrandTotal=Input::get('grand_total');
		$c->Subtotal=Input::get('sub_total');
		$c->AmountInWords=Input::get('amount_in_words');
		$c->PaymentTerms=Input::get('payment_interms');
		$c->ServiceTax=Input::get('service_tax');
		$c->ServiceTaxAmount=Input::get('service_tax_amount');
		$c->swachtax=Input::get('swachtax');
		$c->swachtaxamount=Input::get('swachtaxamount');
		$c->subtotalb=Input::get('subtotalb');
		$c->Status=$varr;
		$c->InvoiceCode=$invoicecode;
		$c->Nameofinvoice=$nameofinvoice;
		$c->dealid=$dealid;
		$c->save(); // you had skipped the parenthesis in your code.

		$insertedId = $c->Id;

		 $invoicedata=Invoice::where('Id',$insertedId)->get();
		
		foreach ($invoicedata as $in) {
		  $inv=$in->InvoiceCode;
		 
		 
		}
		
		$html22 =  View('pdfgenerate')->with(array('invoicedata'=>$invoicedata ))->render();
		$html1 = "<h1>adsfadsfasdf</h1>";
		require_once(app_path().'/libs/html2pdf/html2pdf.class.php');
		$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));
		// $html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html22);

		$htmltosend=$html2pdf->Output('','S');

		$i='Invoice_';
		$b=$inv;

		$h='_Generated';
		$subject =$i . $b . $h;


		Mail::send('emails.test',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend) {
		  // note: if you don't set this, it will use the defaults from config/mail.php
		  $message->from('jeevan@ide-global.com', 'Jeevan');
		  $message->to('harshitha@ide-global.com', 'Sam Jacob')
		    ->subject($subject)
		    ->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
		});
		$request->session()->flash('alert-success', 'Invoice was successful added!');
		        
		  return redirect('executor/dealsclosed');

		    }

		if($variable=='single'){
		$c= new Invoice();
		$c->Particulars=Input::get('purpose');
		$c->CientAddress=Input::get('client_address');
		$c->ClientName=Input::get('client_name');
		$c->Companyname=Input::get('companyname');
		$c->ClientEmail=Input::get('client_email');

		$c->RepresentativeNo=$empid;
		$c->Repname=$empname;
		$c->InvoiceDate=Input::get('invoice_date');
		$c->DueDate=Input::get('due_date');
		$c->SerialNo=Input::get('s_no');
		$c->Eventcode=Input::get('eventcode');
		$c->EventName=$eventname;
		$c->CurrencyType=Input::get('currency_type');
		$c->Amount=Input::get('amount');
		$c->Rcvalue=$exchnagerate ;
		$c->ServiceTax=Input::get('service_tax');
		$c->ServiceTaxAmount=Input::get('service_tax_amount');
		$c->GrandTotal=Input::get('grand_total');
		$c->Subtotal=Input::get('sub_total');
		$c->AmountInWords=Input::get('amount_in_words');
		$c->PaymentTerms=Input::get('payment_interms');
		$c->swachtax=Input::get('swachtax');
		$c->swachtaxamount=Input::get('swachtaxamount');
		$c->subtotalb=Input::get('subtotalb');
		$c->InvoiceCode=$invoicecode;
		$c->Nameofinvoice=$nameofinvoice;
		$c->dealid=$dealid;
		$c->Status=$varr;
		$c->save(); // you had skipped the parenthesis in your code.
		$insertedId = $c->Id;
		// dd($insertedId);

		$invoicedata=Invoice::where('Id',$insertedId)->get();
		// dd($invoicedata->InvoiceCode);
		foreach ($invoicedata as $in) {
		  $inv=$in->InvoiceCode;
		
		  
		}
		//  $inv=$invoicedata->InvoiceCode;
		// dd($inv);

		$i=Deal::where('Id',$dealid)->update(array('Status' => $dealstatus));
		$html22 = View('pdfgenerate')->with(array('invoicedata'=>$invoicedata))->render();

		$html1 = "<h1>adsfadsfasdf</h1>";
		require_once(app_path().'/libs/html2pdf/html2pdf.class.php');

		$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

		// $html2pdf->pdf->SetDisplayMode('fullpage');

		$html2pdf->WriteHTML($html22);

		$htmltosend=$html2pdf->Output('','S');

		$i='Invoice_';
		$b=$inv;

		$h='_Generated';
		$subject =$i .$b .$h;


		Mail::send('emails.test',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend) {
		  // note: if you don't set this, it will use the defaults from config/mail.php
		  $message->from('jeevan@ide-global.com', 'Jeevan');
		  $message->to('harshitha@ide-global.com', 'Sam Jacob')
		    ->subject($subject)
		    ->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
		});

		$request->session()->flash('alert-success', 'Invoice was successful added!');
		         //return redirect()->route('/home');
		       return redirect('executor/dealsclosed');
		    }

}

 public function getEditinvoice()
    {
        //
        
         return view('executor/invoice_edit');
    }

 public function postEditinvoice( Request $request) {

 		 $evname=Input::get('event_name');
		$result=(explode('|', $evname, 2));
		$evcode=trim($result[0]);
		$eventname=trim($result[1]);

		$repnamecode=Input::get('rep_id');
		$result=(explode('|', $repnamecode, 2));
		$empid=trim($result[0]);
		$empname=trim($result[1]);

		 $updateinvoice=Input::get('updateinvoice');
		 $purpose=Input::get('purpose');
		 if($purpose=='annual'){
		    $post = Input::get();


		$i=Invoice::where('Id',$updateinvoice)
		            ->update(array(
	           'Particulars'=> $post['purpose'],
		'CientAddress'=> $post['client_address'],
		'ClientName'=> $post['client_name'],
		'ClientEmail'=> $post['client_email'],
		'Companyname'=>$post['companyname'],
		'RepresentativeNo'=> $empid,
		'Repname'=> $empname,
		'InvoiceDate'=> $post['invoice_date'],
		'DueDate'=> $post['due_date'],
		'AnnualSerialNo'=> $post['s_no_anuual1'],
		'AnnualText'=> $post['anuual_text'],
		'AnnualCurrencyType'=> $post['annual_currency1'],
		'AnnualAmount'=> $post['annual_amount1'],
		'SerialNo'=> $post['s_no'],
		'Eventcode'=> $evcode,
		'EventName'=> $eventname,
		'CurrencyType'=> $post['currency_type'],
		'Amount'=> $post['amount'],
		'GrandTotal'=> $post['grand_total'],
		'AmountInWords'=> $post['amount_in_words'],
		'PaymentTerms'=> $post['payment_interms'],
		'ServiceTax'=> $post['service_tax'],
		'swachtax'=> $post['swachtax'],
		'swachtaxamount'=>$post['swachtaxamount'],
		'subtotalb'=>$post['subtotalb'],
		'Invoice_status'=> 'Attended with Modification',
		'Status'=>'NULL',
		'ServiceTaxAmount'=> $post['service_tax_amount'])
		            );
		            if($i>0){
		  $request->session()->flash('alert-success', 'Updated Success!');
		return redirect('executor/home');
		 
		            }

		 }

		 if($purpose=='single'){
		      $post = Input::get();


		$i=Invoice::where('Id',$updateinvoice)
		            ->update(array(
		'Particulars'=>$post['purpose'],
		'CientAddress'=>$post['client_address'],
		'ClientName'=>$post['client_name'],
		'ClientEmail'=>$post['client_email'],
		'Companyname'=>$post['companyname'],
		'RepresentativeNo'=> $empid,
		'Repname'=> $empname,
		'InvoiceDate'=>$post['invoice_date'],
		'DueDate'=>$post['due_date'],
		'SerialNo'=>$post['s_no'],
		'Eventcode'=> $evcode,
		'EventName'=> $eventname,
		'CurrencyType'=>$post['currency_type'],
		'Amount'=>$post['amount'],
		'ServiceTax'=>$post['service_tax'],
		'ServiceTaxAmount'=>$post['service_tax_amount'],
		'GrandTotal'=>$post['grand_total'],
		'swachtax'=> $post['swachtax'],
		'swachtaxamount'=>$post['swachtaxamount'],
		'subtotalb'=>$post['subtotalb'],
		'AmountInWords'=>$post['amount_in_words'],
		'Invoice_status'=> 'Attended with Modification',
		'Status'=>'NULL',
		'PaymentTerms'=>$post['payment_interms'])

		                );
		            if($i>0){
		 $request->session()->flash('alert-success', 'Updated Success!');
		return redirect('executor/home');
		 
		            }

		 }

		    
		}

public function postDealcancel( Request $request) {
			$dealid=Input::get('dealid');
			$post = Input::get();
			$i=Deal::where('Id',$dealid)
			->update(array(
			'Status' => 'Request Cancel')
			);
			
			
			if($i>0){
			  $request->session()->flash('alert-success', 'Updated Success!');
			return redirect('executor/dealsclosed');

			}

    
}

}