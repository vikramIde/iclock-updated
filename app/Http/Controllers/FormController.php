<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ExchangerateTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LeadsheetRequest;
use App\Http\Requests\VipRequest;
use App\User;
use App\Deal;
use App\invoiceemails;
use App\delegatedealinfo;
use App\reassigned;
use App\benefits;
use App\Invoice;
use App\Employee;
use App\leadsheet;
use App\Targetassign;
use App\vipbooking;
use App\callback;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Event;
use DB;
use Session;
use Validator;
use Mail;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($token)
    {
         return redirect('form/vipbooking');
    }
 public function getVipbooking($token1){
    // dd($token1);
 $status=0;
 $token=explode('===', $token1);

 $lead_id=vipbooking::where('confirmation_code',$token[0])->get();
// dd($lead_id);
    
               foreach($lead_id as $lead){
    $leadcode=$lead->leadcode;
        if($lead->confirmation_code==$token[0])
        {
            $status =1;
        }
    }
    //dd($dealtype);
    
    if($status==1)
    {
 
    
         $dealtype=Deal::where('leadcode',$leadcode)->get(); 
         foreach ($dealtype as $dealt) {
            $evcode=$dealt->Eventcode;
             # code...
         }
         $event=Event::where('eventcode',$evcode)->get();
         $leadsheet=leadsheet::where('leadcode',$leadcode)->get();
          $benefits=benefits::where('leadcode',$leadcode)->get();
            return View('form/vipbooking')->with(array('lead_id'=>$lead_id,'dealtype'=>$dealtype,'event'=>$event,'leadsheet'=>$leadsheet,'benefits'=>$benefits));
      
      }
      else
      {
        echo 'token expired';
      }
}


public function postInsertvipbookingform(VipRequest $request){
 //dd('dasd');
 $post = Input::get();


        
 $editleadid=Input::get('leadid');
 $empid=Input::get('empid');
 $fromemail=Input::get('pemail');

 $email=Employee::where('emp_ide_id',$empid)->get();
 foreach($email as $backemail)
{
    $email=$backemail->email;
}     // dd($editleadid);
        
         $i=vipbooking::where('id',$editleadid)
                 ->update(array(
     'pname'=>$post['pname'],
     'ppassport'=>$post['ppassport'],
     'pnameonbadge'=>$post['pnameonbadge'],
     'snameonbadge'=>$post['snameonbadge'],
     'pemail'=>$post['pemail'],
     'pmobile'=>$post['pmobile'],
     'pdesg'=>$post['pdesg'],
     'sname'=>$post['sname'],
     'spassport'=>$post['spassport'],
     'semail'=>$post['semail'],
     'smobile'=>$post['smobile'],
     'agreedname'=>$post['agreedname'],
     'agreeddate'=>$post['checkindate'],
     'sdesg'=>$post['sdesg'],
     'status'=>'NULL'
     )
 );

                 $subject ='Confirmation Form';


                 Mail::send('emails.backform',['Backform'=>'sdsad'],function($message) use ($subject,$email,$fromemail ) {
            // note: if you don't set this, it will use the defaults from config/mail.php
            $message->from($fromemail);
            $message->to($email)

            ->subject($subject);
    
            });
                    if($i>0){

     $request->session()->flash('alert-success', 'Updated Successfully');
     return Redirect::back();

     }
        

}
}