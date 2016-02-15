<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use App\Http\Middleware\Role;

use App\Event;

use App\User;

use App\Employee;

use App\Invoice;

use Mail;
use DB;


class ReviewerController extends Controller

{



 public function __construct(){



    $this->middleware('role:admin2'); // replace 'collector' with whatever role you need.

}

 

 public function getIndex(){



 	

                

            return redirect('reviewer/home');

 }



 public function getHome(){
     $year= date("Y"); 
                $varr= Auth::user()->empid;

           $evarr=User::where('empid',$varr)->get();

             $edetails=Employee::where('emp_ide_id',$varr)->get();

		    $categories = Event::where( DB::raw('year(date)'), $year)->get();

			$employee = Employee::all();



			  $invoice = Invoice::orderBy('Id', 'DESC')->where( DB::raw('year(InvoiceDate)'), $year)->where( DB::raw('year(DueDate)'), $year)->get();

			$invnull = Invoice::where('Status', '=', 'Null')->get();





			return View('reviewer/home')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice,'invnull'=>$invnull,'edetails'=>$edetails));

 }



 public function getViewinvoice($order_id){



		$id=$order_id;



		$invoicedata=Invoice::where('Id',$id)->get();





		$html22 =  View('viewinvoice')->with(array('invoicedata'=>$invoicedata ))->render();



		require_once(app_path().'/libs/html2pdf/html2pdf.class.php');





		$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));



		// $html2pdf->pdf->SetDisplayMode('fullpage');



		$html2pdf->WriteHTML($html22);



		$html2pdf->Output('Invoice.pdf');

        

      

    }



public function postApproveinvoice( Request $request) {

			$approve_id=Input::get('invoice_approve_id');



			$post = Input::get();

			$i=Invoice::where('Id',$approve_id)->update(array(

			'Status' => $post['approve_status'])

			);

			$invoicedata=Invoice::where('Id',$approve_id)->get();



			foreach($invoicedata as $inv){

			$emails=$inv->ClientEmail;
			
			$invno=$inv->InvoiceCode;

			$clientmail=$inv->ClientName;

			}
			$emls = explode(',',$emails);

				$emails = array();

				foreach($emls as $eml){

					$emails[$eml]='';

				}
			// dd($emails);
                                           // $email = explode(',', $email);
                                        
                                        	///unset($email[count($email)-1]);

                                        	//dd($email);

			if($i>0){



			$html22 =  View('pdfgenerate')->with(array('invoicedata'=>$invoicedata ))->render();





			$html1 = "<h1>adsfadsfasdf</h1>";

			require_once(app_path().'/libs/html2pdf/html2pdf.class.php');





			$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));



			// $html2pdf->pdf->SetDisplayMode('fullpage');



			$html2pdf->WriteHTML($html22);



			$htmltosend=$html2pdf->Output('','S');

			$a='IDE | Proforma invoice_';





			$subject = $a.$invno."|".$clientmail;

			Mail::send('emails.invoice',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend,$emails ) {

			// note: if you don't set this, it will use the defaults from config/mail.php

			$message->from('invoice@ide-global.com', 'IDE Consulting Services Pvt Ltd');

			$message->to($emails)

			->subject($subject)

			->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));

			});



			$request->session()->flash('alert-success', 'Invoice has been sent to client !');

			return redirect('reviewer/home');



			}

}



public function postRejectinvoice( Request $request) {



			$rules = array(



		'reject_comment'=>'required'

		

		);



		$validator = Validator::make(Input::all(), $rules);



		if ($validator->fails())

		{

		return Redirect::back()->withErrors($validator);

		}else {



			$approve_id=Input::get('invoice_reject_id');



			$post = Input::get();

			$i=Invoice::where('Id',$approve_id)->update(array('RejectedwithComments' => $post['reject_comment'],

			          'Status' => $post['reject_status'])

			        );

			        if($i>0){

			          $request->session()->flash('alert-success', 'Updated Success!');

			return redirect('reviewer/home');



			        }





			}

    



}

    



}