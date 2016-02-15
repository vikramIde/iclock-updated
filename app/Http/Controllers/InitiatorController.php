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

use App\benefits;
use App\delegatedealinfo;
use App\reassigned;
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



class InitiatorController extends Controller
{

 use ExchangerateTrait;
 public function __construct(){

    $this->middleware('role:sales'); // replace 'collector' with whatever role you need.
}
 
 public function getIndex(){

 	   
            return redirect('initiator/home');
 }

 public function getHome(){
                
		// 	$empid= Auth::user()->empid;
		// 	$userdetails = User::where('empid',$empid)->get();
		// 	$empdet = Employee::where('emp_ide_id',$empid)->get();
			
		// 	$targets = Targetassign::where('Employeeid',$empid)->get();
		// 	foreach($targets as $target){
		// 	$ecode = $target['Eventcode'];
		// }
		// 	$deals = Deal::where('Empid',$empid)->get();
		// 	$eventDate = Event::where('eventcode',$ecode)->select('date')->get();
		// 	$userData = array();
		// 	$variancedata=array();
		// 	$key = 0 ;
		// 		foreach($eventDate as $val)
		// 		$eventdate = $val['date'];

		// foreach ($targets as $target) {

		// 				$achieved = 0;
		// 				$userData[$key]['eventc']=$target->Eventcode;
		// 				$userData[$key]['event']=$target->Eventname;
		// 				$userData[$key]['cur']= $target->Currency;
		// 				$userData[$key]['targetVal']=$target->Targetvalue;
		// 				$userData[$key]['startdate']=$target->Targetassigned;
		// 				$userData[$key]['enddate']=$target->Targetdate;

		// 		foreach ($deals as $deal) {

		// 		if($target->Eventname == $deal->Eventname && $target->Employeeid == $deal->Empid)
		// 		{
		// 				$achieved = $achieved+$deal->Dealvalue;		
		// 		}
		// 		}

		// 				$userData[$key]['achieved']=$achieved;
		// 				$userData[$key]['variance']=$achieved-$target->Targetvalue;

		// 				$date2= strtotime(date('d-m-Y'));

		// 				$date1=$target->Targetdate;
		// 				$date3=strtotime($target->Targetdate);

		// 		if($date2>$date3){
		// 				$days=0;
		// 				$userData[$key]['dayleft']=$days;


		// 		}
		// 		else{

		// 				$diff=$date3-$date2;
		// 				$days=floor($diff/(60*60*24));
		// 				// dd($days); 
		// 				$userData[$key]['dayleft']=$days;

		// 		}

		// 		$key++;
		// }

$empid= Auth::user()->empid;
$emp=Employee::where('emp_ide_id',$empid)->get();
      return View('initiator/home')->with(array('emp'=>$emp));
 }
 public function getTarget(){
                
			$empid= Auth::user()->empid;
			$empid= Auth::user()->empid;
$emp=Employee::where('emp_ide_id',$empid)->get();
			$userdetails = User::where('empid',$empid)->get();
			$targets = Targetassign::where('Employeeid',$empid)->get();
			$ecode=array();
			foreach($targets as $target)
			$ecode = $target['Eventcode'];

			$deals = Deal::where('Empid',$empid)->get();
			$eventDate = Event::where('eventcode',$ecode)->select('date')->get();
			$userData = array();
			$variancedata=array();
			$key = 0 ;
				foreach($eventDate as $val)
				$eventdate = $val['date'];

		foreach ($targets as $target) {

						$achieved = 0;
						$userData[$key]['eventc']=$target->Eventcode;
						$userData[$key]['event']=$target->Eventname;
						$userData[$key]['cur']= $target->Currency;
						$userData[$key]['targetVal']=$target->Targetvalue;
						$userData[$key]['startdate']=$target->Targetassigned;
						$userData[$key]['enddate']=$target->Targetdate;

				foreach ($deals as $deal) {

				if($target->Eventname == $deal->Eventname && $target->Employeeid == $deal->Empid)
				{
						$achieved = $achieved+$deal->Dealvalue;		
				}
				}

						$userData[$key]['achieved']=$achieved;
						$userData[$key]['variance']=$achieved-$target->Targetvalue;

						$date2= strtotime(date('d-m-Y'));

						$date1=$target->Targetdate;
						$date3=strtotime($target->Targetdate);

				if($date2>$date3){
						$days=0;
						$userData[$key]['dayleft']=$days;


				}
				else{

						$diff=$date3-$date2;
						$days=floor($diff/(60*60*24));
						// dd($days); 
						$userData[$key]['dayleft']=$days;

				}

				$key++;
		}


      return View('initiator/target')->with(array('deals'=>$deals,'userdata'=>$userData,'target'=>$targets,'variancedata'=>$variancedata,'emp'=>$emp));
 }
 public function getDeals(){
 	$empid= Auth::user()->empid;
 	$varr= Auth::user()->empid;
		$evarr=User::where('empid',$varr)->get();
		$emp=Employee::where('emp_ide_id',$varr)->get();
 	$deals = Deal::where('Empid',$empid)->get();
 	// $delegatedeal=Deal::where('Empid',$empid)->get();
 	$delegatedeal=DB::table('deal')
      
         ->join('delegateinfo', 'deal.leadcode','=','delegateinfo.leadid')
            ->get();
            // dd($delegatedeal);
 	return View('initiator/deals')->with(array('deals'=>$deals,'emp'=>$emp,'delegatedeal'=>$delegatedeal));
 }

public function getAutocomplete(){
	$term = Input::get('term');

	$results = array();
	
	$queries = \DB::table('users')
		->where('name', 'LIKE', '%'.$term.'%')
		->take(5)->get();
	
	foreach ($queries as $query){
	    $results[] = [ 'id' => $query->id, 'value' => $query->name.' '.$query->email ];
	}
return \Response::json($results);
}

public function getMycancellation(){

		$varr= Auth::user()->empid;
		$evarr=User::where('empid',$varr)->get();
		$edetails=Employee::where('emp_ide_id',$varr)->get();
		$date= date('Y-m-d');
		$ev=array();
		$cat=Event::where('date','>=',$date)->get();
		// dd($cat);
		foreach ($cat as $key) {
			$ev[]=$key['eventcode'];

		}
		// dd($ev);
		$dealcan = Deal::where('Status','=','Request Cancel')->where('Empid',$varr)->get();
		
		$empid=Targetassign::where('Employeeid',$varr)->whereIn('Eventcode',$ev)->get();

		$invcancel=DB::table('deal')
      
         ->join('event_invoice', 'deal.Id','=','event_invoice.dealid')->where('deal.Status','=','Request Cancel')->where('deal.Empid','=',$varr)->where('event_invoice.RepresentativeNo','=',$varr)->where('event_invoice.Status','=','Request Cancel')
            ->get();
           
		return View('initiator/mycancellation')->with(array('cat' =>$cat,'empid'=>$empid,'evarr'=>$evarr,'dealcan'=>$dealcan,'invcancel'=>$invcancel,'edetails'=>$edetails));
 }
 
public function postDealinsert( Request $request ) {

	 //           $leadid = Input::get('leadid');
		// dd($leadid);
		$data = Input::get();
		$eventcode=Input::get('eventname');
		$result=(explode('|', $eventcode, 2));
		$eventcode=trim($result[0]);
		$eventname=trim($result[1]);
		//emp id and name

		$eid=Input::get('emp_id');
		$result=(explode('|', $eid, 2));
		$emid=trim($result[0]);
		$ename=trim($result[1]);
		
		$leadid = Input::get('leadid');
		$empdept= Input::get('empdept');


		
		$rules = array(

		'eventname'=>'required',
		'company'=>'required',
		'dealdate'=>'required',
		'deal_value'=>'required',
		'deal_curr'=>'required',
		
		'deal_type'=>'required'

		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
		return Redirect::back()->withErrors($validator);
		}else {

		
		$dealstatus='1';
		$c= new Deal();
		$ydate=date('Y-m-d',strtotime("-1 days"));
		// dd($ydate);

		if($data['deal_curr']!='INR'){
			
			$exchnagerate = $this->getExchangex( $data['deal_value'], $data['deal_curr'],$ydate);


		}
		else{

			$exchnagerate=$data['deal_value'];

		}
		
		$c->Clientname = $data['clientname'];

		$c->Companyname = $data['company'];
		$c->Eventcode=$eventcode;
		$c->Eventname  = $eventname;
		$c->billingadd = $data['billingadd'];
		$c->Dealdate = $data['dealdate'];
		$c->Dealvalue = $data['deal_value'];
		$c->Dealtype= $data['deal_type'];
		$c->Dealcurr = $data['deal_curr'];
		$c->Rcvalue=$exchnagerate ;
		
		$c->Empid = $emid;
		$c->Empname = $ename;
		$c->leadcode = $data['leadcode'];

		$c->Status=$dealstatus;
		// dd($exchnagerate);
		$c->save();
		$lastinsertid=$c->Id;
		// dd($lastinsertid);

			for($i = 0; $i < count($data['name']); $i++) {

				// dd(count($data['name']));
				$invemail= new invoiceemails();

				$invemail->name = $data['name'][$i];
				$invemail->email = $data['email'][$i];
				$invemail->mobile = $data['mobile'][$i];
				$invemail->desg = $data['desg'][$i];
				$invemail->dept = $data['dept'][$i];
				$invemail->invoicemark = $data['preferred'][$i];
				
				$invemail->deal_id = $lastinsertid;
		
				$invemail->leadcode = $data['leadcode'];

			
				$invemail->save();
			    
			 }

	
		}



		
		$request->session()->flash('alert-success', 'Deal Has Been inserted Successfully');
		return redirect('initiator/deals');
		// 

		}


public function getVariancecard(){

       $dealjson='';
      $empid= Auth::user()->empid;
$empid= Auth::user()->empid;
$emp=Employee::where('emp_ide_id',$empid)->get();
      $targets = Targetassign::where('Employeeid',$empid)->get();
      $variancedata=array();
      $targetdate =0;
      $eventdate =0;
      return View('initiator/variance')->with(array('dealjson'=>$dealjson,'target'=>$targets,'variancedata'=>$variancedata,'targetdate'=>$targetdate,'eventdate'=>$eventdate,'emp'=>$emp));
}



public function postVariancecard(){
		
		    $empid= Auth::user()->empid;
		    $eventName = Input::get('event');
		    $targets = Targetassign::where('Employeeid',$empid)->where('Eventname',$eventName)->get();
		    $variancedata=$targets;
		    $deals = Deal::where('Eventname',$eventName)->where('Empid',$empid)->get();

		    $eventDate = Event::where('event',$eventName)->select('date')->get();
		    $userData = array();
		    $key = 0 ;


		    foreach($eventDate as $val)
		      $eventdate = $val['date'];

		    foreach ($targets as $target) {
		                $achieved = 0;
		                $userData[$key]['event']=$target->Eventname;
		                  $userData[$key]['eventcode']=$target->Eventcode;
		                $userData[$key]['targetVal']=$target->Targetvalue;

		        foreach ($deals as $key1=> $deal) {

		            if($target->Eventname == $deal->Eventname){
		                $achieved = $achieved+$deal->Dealvalue;
		                $dealx[$key1]['dealdate'] = $deal->Dealdate;
		                $dealx[$key1]['cost'] = (float)$deal->Dealvalue;

		          }
		        }

		        $userData[$key]['achieved']=$achieved;
		        $userData[$key]['variance']=$achieved-$target->Targetvalue;
		        $userData[$key]['cur']= $target->Currency;
		        $date2= strtotime(date('Y-m-d'));
		        $date1=$target->Targetdate;
		         $date5=$target->Targetassigned;
		         // dd($date5);
		        $date3=strtotime($target->Targetdate);
		        $diff=$date3-$date2;
		        $days=floor($diff/(60*60*24));
		        // dd($days); 
		        $userData[$key]['dayleft']=$days;
		        $key++;
  }

    $dealjson = json_encode($dealx);
    // dd($dealjson);
    return View('initiator/variance')->with(array('target'=>$targets,'userdata'=>$userData, 'variancedata'=>$variancedata,'eventdate'=>$date1,'targetdate'=>$date5,'dealjson'=>$dealjson));

}

public function postDealcancleyes(Request $request){
		$dealcancelid=Input::get('dealid');
		$comment=Input::get('comment');

		
		 $can='cancelled';
		 // dd($dealcancelid);
		 	$i=Deal::where('Id',$dealcancelid)
			->update(array(
			'Status' => $can,
			'comment' => $comment)
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return View('initiator/mycancellation');

			}

    }    

    public function postDealcancleno(Request $request){
    	$dealcancelid=Input::get('dealid');
    	$comment=Input::get('comment');

		
		 $can='pending deal cancel';
		 // dd($dealcancelid);
		 	$i=Deal::where('Id',$dealcancelid)
			->update(array(
			'Status' => $can,
			'comment' => $comment)
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Updated Success!');
			return View('initiator/mycancellation');

			}

    } 

public function getLeadsheet(){
	$varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
             $edetails=Employee::where('emp_ide_id',$varr)->get();

           $leads=leadsheet::where('empid',$varr)->where('callback','=','0')->where('followup','=','0')->where('reassignedId','=','0')->where('dealclose','=','')->where('blowout','=','')->get();
	 $assignedme = leadsheet::where('reassignedId',$varr)->where('reassigned','=',1)->where('leadcat','!=','Marketing')->get(); 
	

	$reassignedleads=DB::table('leadsheet')
      
         ->join('reassigned', 'leadsheet.leadcode','=','reassigned.leadcode')->where('reassigned.assigntoid','=',$varr)->get();
          $mlead=DB::table('leadsheet')
      
         ->join('reassigned', 'leadsheet.leadcode','=','reassigned.leadcode')->where('reassigned.assigntoid','=',$varr)->where('leadsheet.leadcat','=','Marketing')->get();
	     // $mlead = leadsheet::where('reassignedId',$varr)->where('reassigned','=',1)->where('leadcat','=','Marketing')->get(); 
	// dd($reassignedleads);
	   $salesman_list = Employee::where('emp_department','=','Vendors')->where('emp_status','=','Active')->where('emp_ide_id','!=',$varr)->get();
	    $dellist = Employee::where('emp_department','=','Delegates')->where('emp_status','=','Active')->where('emp_ide_id','!=',$varr)->get();
	     $sales = Employee::where('cat','=','Sales')->where('emp_status','=','Active')->where('emp_ide_id','!=',$varr)->get();
		
      return View('initiator/leadsheet')->with(array('evarr'=>$evarr,'assignedme'=>$assignedme,'leads'=>$leads,'salesman_list'=>$salesman_list,'edetails'=>$edetails,'dellist'=>$dellist,'mlead'=>$mlead,'sales'=>$sales,'reassignedleads'=>$reassignedleads));
}
public function getUpdatenewdeal($editleadid){

	$varr= Auth::user()->empid;
		$evarr=User::where('empid',$varr)->get();
		$emp=Employee::where('emp_ide_id',$varr)->get();
		
		$date= date('Y-m-d');
		$ev=array();
		$cat=Event::where('date','>=',$date)->get();
		// dd($cat);
		foreach ($cat as $key) {
			$ev[]=$key['eventcode'];

		}
		// dd($ev);
		$leadid=leadsheet::where('id',$editleadid)->get();
		// dd($leadid);
		$dealcan = Deal::where('Status','=','Request Cancel')->where('Empid',$varr)->get();
		$event=Event::all();
		$empid=Targetassign::where('Employeeid',$varr)->whereIn('Eventcode',$ev)->get();

	return View('initiator/updatenewdeal')->with(array('evarr'=>$evarr,'emp'=>$emp,'empid'=>$empid,'leadid'=>$leadid,'cat'=>$cat));
   
}

public function postGenerateleadsheet( LeadsheetRequest $request ) {


		
		$data = Input::get();
		$c= new leadsheet();
		$eid=Input::get('emp_id');
		$result=(explode('|', $eid, 2));
		$emid=trim($result[0]);
		$ename=trim($result[1]);
		$variable=Input::get('empdept');

		$dateValue=date('d-m-Y');
		$time=strtotime($dateValue);
		$year=date("Y",$time);
		if($variable=='Vendors'){
			$leadcode='VL';
			$count = leadsheet::where('leadcat','=','Vendors')->count();
			$counti = str_pad($count+1, 5, '0', STR_PAD_LEFT);
	                     $leadc=$leadcode.''.$year.''.$counti;
		     	// dd($leadc);

		}
		if($variable=='Delegates'){
			$leadcode='DL';
			$count = leadsheet::where('leadcat','=','Delegates')->count();
		          $counti = str_pad($count+1,5, '0', STR_PAD_LEFT);
		          $leadc=$leadcode.''.$year.''.$counti;
			
		}

		$c->company_name = $data['company_name'];
		$c->country = $data['country'];
		$c->website = $data['website'];
		$c->leadcode = $leadc;
		$c->leadcat = $data['empdept'];
		$c->product_category = $data['product_category'];
		$c->product_sub_category = $data['product_sub_category'];
		$c->phone = $data['boardline'];
		$c->otheroffice = $data['office_number'];
		$c->fax = $data['fax'];
		$c->partnership_package_name = $data['pname'];
		$c->partnership_package_value = $data['pvalue'];

		$c->dmname = $data['dmname'];
		$c->dmdesignation = $data['dmdesignation'];
		$c->dmphone = $data['dmphone'];
		$c->dmmobile = $data['dmmobile'];
		$c->dmemail = $data['dmemail'];
		$c->dmaltnumber = $data['dmaltnumber'];

		$c->infname = $data['infname'];
		$c->infdesignation = $data['infdesignation'];
		$c->infphone = $data['infphone'];
		$c->infmobile = $data['infmobile'];
		$c->infemail = $data['infemail'];
		$c->infaltnumber = $data['infaltnumber'];

		$c->specname = $data['specname'];
		$c->specdesignation = $data['specdesignation'];
		$c->specphone = $data['specphone'];
		$c->spemobile = $data['spemobile'];
		$c->speemail = $data['speemail'];
		$c->spealtnumber = $data['spealtnumber'];

		$c->remarks = $data['remarks'];
		$c->competitors = $data['competitors'];
		$c->empid = $emid;
		$c->empname = $ename;
		$c->callback = '0';
		$c->followup = '0';
		$c->reassignedId = '0';
		
		$c->save();

		$request->session()->flash('alert-success', 'Lead Has Been inserted Successfully');
		return redirect('initiator/leadsheet');
		// 

 }
 
 public function postReassignlead(Request $request){

 			$data=Input::get();
 			//emp name and id

 			$eid=Input::get('emp_id');
			$result=(explode('|', $eid, 2));
			$emid=trim($result[0]);
			$ename=trim($result[1]);

			$eid=Input::get('assignedid');
			$res=(explode('|', $eid, 2));
			$empreid=trim($res[0]);
			$emprename=trim($res[1]);

 			$leadid=$data['leadid'];
 			if(empty($data['reassigned'])){
 			$lead = leadsheet::find($data['leadid']);
 			// dd($lead);
 			$lead->reassigned =0;
 			$lead->save();

		        }
		            $assign=new reassigned();

		           $assign->leadid = $data['leadid'];
		           $assign->leadcode =  $data['leadcode'];
			$assign->assigntoid = $empreid;
			$assign->assigntoname = $emprename;
			$assign->assignedbyid = $emid;
			$assign->assignedbyname = $ename;
			$assign->save();
			// $updateLead = Input::get();
			// $eid=Input::get('assignedid');
			// $result=(explode('|', $eid, 2));
			// $emid=trim($result[0]);
			// $ename=trim($result[1]);
			// if(!empty($updateLead['assignedid'])){
				
			// 	$lead = leadsheet::find($updateLead['leadid']);
			// 	$lead->reassigned =1;
			// 	$lead->reassignedId =$emid;
			// 	$lead->reassignedempname =$ename;
				
			
			// 	$lead->save();
				
			// 	}
				$request->session()->flash('alert-success', 'Comment inserted Successfully');
				return redirect('initiator/leadsheet');
 }
 
 public function getEditlead($leadid){
	$lead_id=leadsheet::where('id',$leadid)->get();
      return View('initiator/editlead')->with(array('lead_id'=>$lead_id));
}
 public function getBlowoutleads(){
 	$varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
           $edetails=Employee::where('emp_ide_id',$varr)->get();
	$blowout=leadsheet::where('status','=','0')->where('empid',$varr)->get();
	// $query = leadsheet::find(2)->callback;

	// $query = DB::table('leadsheet')
 //    ->select(DB::raw('COUNT(callback.leadcode) as calls,(leadsheet.leadcode) as leads'))
  
 //    ->join('callback', 'leadsheet.leadcode', '=', 'callback.leadcode')
  
 //    ->get();

// dd($query);
      return View('initiator/blowoutleads')->with(array('blowout'=>$blowout,'edetails'=>$edetails));
}
 public function getPendingforfollowup(){
 	$varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
           $edetails=Employee::where('emp_ide_id',$varr)->get();
           //dd($evarr);
	$lead_id=leadsheet::where('followup','=','1')->where('empid',$varr)->get();
	//dd($lead_id);
      return View('initiator/pendingforfollowup')->with(array('lead_id'=>$lead_id,'edetails'=>$edetails));
}

public function getCallbacksheet($leadid){
	$varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
             $emp=Employee::where('emp_ide_id',$varr)->get();
           $leadscallback=callback::where('leadid',$leadid)->get();
        
           $lead_id=leadsheet::where('id',$leadid)->get();
             $salesman_list = Employee::where('emp_department','=','Vendors')->where('emp_status','=','Active')->where('emp_ide_id','!=',$varr)->get();
             $dellist = Employee::where('emp_department','=','Delegates')->where('emp_status','=','Active')->where('emp_ide_id','!=',$varr)->get();
      return View('initiator/callbacksheet')->with(array('emp'=>$emp,'lead_id'=>$lead_id,'leadscallback'=>$leadscallback,'salesman_list'=>$salesman_list,'dellist'=>$dellist));
}
public function getCallbackassigned(){
	$varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
           $emp=Employee::where('emp_ide_id',$varr)->get();
         //$callbackassign=DB::table('leadsheet')->join('callback', 'leadsheet.id','=','callback.leadid')->where('callback.callbackassignto','=',$varr)->get();
           $callbackassign=leadsheet::where('callbackassignid',$varr)->where('dealclose','=','')->where('blowout','=','')->get();
             $callbackassignbyme=leadsheet::where('callbackassignby',$varr)->get();
        
      return View('initiator/callbackassigned')->with(array('callbackassign'=>$callbackassign,'callbackassignbyme'=>$callbackassignbyme,'emp'=>$emp));
}

 public function getDealclose(){
 	$varr= Auth::user()->empid;
 	$edetails=Employee::where('emp_ide_id',$varr)->get();
	$lead_id=leadsheet::where('blowout','=','1')->where('empid',$varr)->get();
	$dealclose=leadsheet::where('dealclose','=','1')->where('empid',$varr)->get();
      return View('initiator/dealclose')->with(array('lead_id'=>$lead_id,'dealclose'=>$dealclose,'edetails'=>$edetails));
}
public function postUpdateleadsheet( Request $request ) {
		
		$post = Input::get();
		$editleadid=Input::get('leadid');
		// dd($editleadid);
		
			$i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'company_name'=>$post['company_name'],
		'product_category'=>$post['product_category'],
		'phone'=>$post['phone'],
		'website'=>$post['website'],
		'product_sub_category'=>$post['product_sub_category'],
		'otheroffice'=>$post['office_number'],
		'fax'=>$post['fax'],
		'partnership_package_name'=>$post['pname'],
		'partnership_package_value'=> $post['pvalue'],
		'dmname'=> $post['dmname'],
		'dmdesignation'=>$post['dmdesignation'],
		'dmphone'=>$post['dmphone'],
		'dmmobile'=>$post['dmmobile'],
		'dmemail'=>$post['dmemail'],
		'dmaltnumber'=> $post['dmaltnumber'],
		'infname'=> $post['infname'],
		'infdesignation'=>$post['infdesignation'],
		'infphone'=>$post['infphone'],
		'infmobile'=>$post['infmobile'],
		'infemail'=>$post['infemail'],
		'infaltnumber'=>$post['infaltnumber'],
		'specname'=> $post['specname'],
		'specdesignation'=>$post['specdesignation'],
		'specphone'=>$post['specphone'],
		'spemobile'=>$post['spemobile'],
		'speemail'=>$post['speemail'],
		'spealtnumber'=>$post['spealtnumber'],
		'remarks'=>$post['remarks'],
		'competitors'=>$post['competitors'])

		                );
		            if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/leadsheet');

		}
		
	
 }

 public function postCallbackform( Request $request ) {
	
		$data = Input::get();
		$c= new callback();


		$eid=Input::get('emp_id');
		$result=(explode('|', $eid, 2));
		$emid=trim($result[0]);
		$ename=trim($result[1]);
		$date=$data['nextcalldate'];
		$dtime=$data['nexttime'];
		$ctime=$data['timeofcall'];
		$ddtime=date('H:i:s',strtotime($dtime));
		$cctime=date('H:i:s',strtotime($ctime));
		
		$datetime=$date.' '.$ddtime;
		// dd($cctime);
		

		$c->leadid = $data['lead_edit_id'];
		$c->leadcode = $data['leadcode'];
		$c->empid = $emid;
		$c->empname = $ename;
		$c->timeofcall = $cctime;
		$c->results = $data['results'];
		$c->nextcalldate = $datetime;
		$c->schedule = $data['schedule'];
		$c->pitchedperson = $data['pitchedperson'];
		

		
		$c->save();
		$leadidc = $c->leadid;
		$i=leadsheet::where('id',$leadidc)
		            ->update(array(
		'followup'=>'1')

		                );

		$request->session()->flash('alert-success', 'updated');
		return redirect('initiator/callbacksheet/'.$leadidc);
		// 


 }
  public function postCallbackassign( Request $request ) {
	
		$post = Input::get();
		$eid=Input::get('assignedid');
		$result=(explode('|', $eid, 2));
		$emid=trim($result[0]);
		$ename=trim($result[1]);

		$eid2=Input::get('emp_id');
		$result2=(explode('|', $eid2, 2));
		$emid2=trim($result2[0]);
		$ename2=trim($result2[1]);

		$editleadid=Input::get('lead_edit_id');
	$i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'callback'=>'1',
		'followup'=>'0',
		'callbackassignby'=>$emid2,
		'callbackassignbyname'=>$ename2,
		'callbackassignid'=>$emid,
		'callbackassignname'=>$ename)

		                );

		        
		            if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/callbacksheet/'.$editleadid);

 }
}
  public function postDealclosing( Request $request ) {
	
		$post = Input::get();
		

		$eid2=Input::get('emp_id');
		$result2=(explode('|', $eid2, 2));
		$emid2=trim($result2[0]);
		$ename2=trim($result2[1]);

		$editleadid=Input::get('lead_edit_id');
	$i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'dealclose'=>'1',
		
		'dealclosebyid'=>$emid2,
		'dealclosebyname'=>$ename2
		)

		                );

		        
		            if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/callbackassigned');

 }
}
  public function postBlowoutdeal( Request $request ) {
	
		$post = Input::get();
		
		$eid2=Input::get('emp_id');
		$result2=(explode('|', $eid2, 2));
		$emid2=trim($result2[0]);
		$ename2=trim($result2[1]);

		$editleadid=Input::get('lead_edit_id');
	$i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'blowout'=>'1',
	
		'blowoutbyid'=>$emid2,
		'blowoutbyname'=>$ename2
		)

		                );

		        
		            if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/callbackassigned');

 }
}
  public function postUpdatedealclosefinal( Request $request ) {
	
		
		$rules = array(

		'sent_date'=>'required',
		'rec_date'=>'required'
		
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
		return Redirect::back()->withErrors($validator);
		}else {

		
                      $post = Input::get();
		$editleadid=Input::get('leadid');
	           $i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'dealclose'=>'0',
		'contsentdate'=>$post['sent_date'],
		'contrecdate'=>$post['rec_date'],
	
		'status'=>'1'
		
		)

		                );

		        
		 if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/updatenewdeal/'.$editleadid);

 }
}
}
public function postUpdateblowoutfinal( Request $request ) {
	
		$post = Input::get();
		
		$editleadid=Input::get('leadid');
	          $i=leadsheet::where('id',$editleadid)
		            ->update(array(
		'blowout'=>'0',
	
		'status'=>'0'
		
		)  );

		        
		            if($i>0){
		$request->session()->flash('alert-success', 'Updated Successfully');
		return redirect('initiator/leadsheet');

 }
}

public function postReactivatedeal( Request $request ) {

		$reactivateleadid=Input::get('leadid');
		
		$recdeal=leadsheet::where('id',$reactivateleadid)->get();
		// dd($recdeal);
		foreach ($recdeal as $deald) {
			# code...
		}

		$c= new leadsheet();
		$dateValue=date('d-m-Y');
		$time=strtotime($dateValue);
		$year=date("Y",$time);
		if($deald['leadcat']=='Vendors'){
			$leadcode='VL';
			$count = leadsheet::where('leadcat','=','Vendors')->count();
			$counti = str_pad($count+1, 5, '0', STR_PAD_LEFT);
	                     $leadc=$leadcode.''.$year.''.$counti;
		     	// dd($leadc);

		}
		

		$c->company_name = $deald['company_name'];
		$c->country = $deald['country'];
		$c->website = $deald['website'];
		$c->leadcode = $leadc;
		$c->leadcat = $deald['leadcat'];
		$c->product_category = $deald['product_category'];
		$c->product_sub_category = $deald['product_sub_category'];
		$c->phone = $deald['phone'];
		$c->otheroffice = $deald['otheroffice'];
		$c->fax = $deald['fax'];
		$c->partnership_package_name = $deald['partnership_package_name'];
		$c->partnership_package_value = $deald['partnership_package_value'];

		$c->dmname = $deald['dmname'];
		$c->dmdesignation = $deald['dmdesignation'];
		$c->dmphone = $deald['dmphone'];
		$c->dmmobile = $deald['dmmobile'];
		$c->dmemail = $deald['dmemail'];
		$c->dmaltnumber = $deald['dmaltnumber'];

		$c->infname = $deald['infname'];
		$c->infdesignation = $deald['infdesignation'];
		$c->infphone = $deald['infphone'];
		$c->infmobile = $deald['infmobile'];
		$c->infemail = $deald['infemail'];
		$c->infaltnumber = $deald['infaltnumber'];

		$c->specname = $deald['specname'];
		$c->specdesignation = $deald['specdesignation'];
		$c->specphone = $deald['specphone'];
		$c->spemobile = $deald['spemobile'];
		$c->speemail = $deald['speemail'];
		$c->spealtnumber = $deald['spealtnumber'];

		$c->remarks = $deald['remarks'];
		$c->competitors = $deald['competitors'];
		$c->empid = $deald['empid'];
		$c->empname = $deald['empname'];
		$c->callback = '0';
		$c->followup = '0';
		$c->reassignedId = '0';
		
		$c->save();

		$request->session()->flash('alert-success', 'Lead Has Been inserted Successfully');
		return redirect('initiator/leadsheet');
		// 

		
 }
 public function postDelegatedealclose(){

 	$post=Input::get();
 	$editleadid=$post['leadid'];
 	$leadcode=$post['leadcode'];


 	if($post['boq']=='1'){

 		$save=leadsheet::where('id',$editleadid)
		            ->update(array(
		'boq'=>$post['boq']
		)  );
		
		

 		return redirect('initiator/updatenewdeal/'.$editleadid.'');
 		
 	}

 	if($post['boq']=='0'){

 		 $save=leadsheet::where('id',$editleadid)
		            ->update(array(
		'boq'=>$post['boq'],
		'blowout'=>'0',
	
		'status'=>'0'
	
		
		)  );
 		return redirect('initiator/blowoutleads/');
 		
 	}

		            

 }
 public function postDelegatedealupload( Request $request){

 	                     $data=Input::get();
 	                  
			$eventcode=Input::get('eventname');
			$result=(explode('|', $eventcode, 2));
			$eventcode=trim($result[0]);
			$eventname=trim($result[1]);
			//emp id and name

			$eid=Input::get('emp_id');
			$result=(explode('|', $eid, 2));
			$emid=trim($result[0]);
			$ename=trim($result[1]);

			$leadid = Input::get('leadid');
			$empdept= Input::get('empdept');



			$dealstatus='1';
			$dealtype='single';
			$c= new Deal();

			$ydate=date('Y-m-d',strtotime("-1 days"));
		// dd($ydate);

		if($data['deal_curr']!='INR'){
			
			$exchnagerate = $this->getExchangex( $data['deal_value'], $data['deal_curr'],$ydate);


		}
		else{

			$exchnagerate=$data['deal_value'];

		}

			if($data['kindofsub']=='paid'){
				$dealvalue=$data['deal_value'];
				$dealcurr=$data['deal_curr'];
				

			}
			if($data['kindofsub']=='free'){
				$dealvalue='0';
				$dealcurr='0';
			

			}

			$c->Companyname = $data['company'];
			$c->billingadd = $data['billingadd'];
			
			$c->Eventcode=$eventcode;
			$c->Eventname  = $eventname;
			$c->Dealdate = $data['dealdate'];
			$c->Dealvalue = $dealvalue;
			$c->kindofsub = $data['kindofsub'];
			$c->Dealcurr = $dealcurr;
			$c->Rcvalue=$exchnagerate ;
			$c->Empid = $emid;
			$c->Empname = $ename;
			$c->leadcode = $data['leadcode'];
			$c->Status=$dealstatus;
			$c->Dealtype=$dealtype;

			$c->save();
			$lastinsertid=$c->Id;
			
			
			$updatedeal= new delegatedealinfo();
			$updatedeal->deal_id= $lastinsertid;
			$updatedeal->leadcode=$data['leadcode'];
			$updatedeal->boq= '1';
			$updatedeal->vip= 'NULL';
			$updatedeal->hotel= 'NULL';
			$updatedeal->logo= 'NULL';
			$updatedeal->save();

			$benefit= new benefits();
			$benefit->deal_id= $lastinsertid;
			$benefit->leadcode=$data['leadcode'];
			$benefit->hotelaccommodation= $data['hotelacc'];
			$benefit->specification= $data['specification'];
			$benefit->flightticket= $data['flight'];
			$benefit->airportpickupdrop= $data['airport'];
			$benefit->visa=$data['visa'];			
			$benefit->save();

			for($i = 0; $i < count($data['name']); $i++) {

				// dd(count($data['name']));
				$invemail= new invoiceemails();

				$invemail->name = $data['name'][$i];
				$invemail->email = $data['email'][$i];
				$invemail->mobile = $data['mobile'][$i];
				$invemail->desg = $data['desg'][$i];
				$invemail->dept = $data['dept'][$i];
				
				$invemail->invoicemark = $data['preferred'][$i];
				
				$invemail->deal_id = $lastinsertid;
		
				$invemail->leadcode = $data['leadcode'];

			
				$invemail->save();
			    
			 }
return redirect('initiator/pendingactivity/');
	
 	
 }

  public function getPendingactivity(){
  	$varr= Auth::user()->empid;
		$evarr=User::where('empid',$varr)->get();
		$emp=Employee::where('emp_ide_id',$varr)->get();
 	$deals = Deal::where('Empid',$varr)->where('Empid',$varr)->where( DB::raw('year(Dealdate)'), '=', '2016' )->get();

 	$dealnum=array();
 	$leadcode=array();
 	foreach($deals as $deal){
 	$dealnum=$deal->Id;
 	$leadcode=$deal->leadcode;
 	}
 	$dealinfo=delegatedealinfo::where('deal_id',$dealnum)->where('leadcode',$leadcode)->get();
 	//dd(count($dealinfo));
 	
            // dd($delegatedeal);
 	return View('initiator/pendingactivity')->with(array('deals'=>$deals,'emp'=>$emp,'dealinfo'=>$dealinfo));
  }
 public function getEditdeal($dealid){
 	// dd($dealid);
 	$varr= Auth::user()->empid;
	$evarr=User::where('empid',$varr)->get();
	$emp=Employee::where('emp_ide_id',$varr)->get();
	foreach($emp as $empp){
		$fromemail=$empp->email;
	}
	// dd($fromemail);
		
	$lead_id=Deal::where('leadcode',$dealid)->get();
	foreach($lead_id as $editlead){
	$dealid=$editlead->Id;
	$leadcode=$editlead->leadcode;
	}
	$editlead=vipbooking::where('leadcode',$leadcode)->where('deal_id',$dealid)->where('id', DB::raw("(select max(`id`) from vipbooking)"))->get();
	$delegateinfo=delegatedealinfo::where('leadcode',$leadcode)->where('deal_id',$dealid)->get();
	//dd(count($editlead));
      return View('initiator/editdeal')->with(array('lead_id'=>$lead_id,'editlead'=>$editlead,'emp'=>$emp,'delegateinfo'=>$delegateinfo));
}

 // public function getVipbooking($token){
 // $status=0;
 
 // $lead_id=vipbooking::where('confirmation_code',$token)->get();

	
	// foreach($lead_id as $lead){
	// $leadocde=$lead->leadcode;
	// 	if($lead->confirmation_code==$token)
	// 	{
	// 		$status =1;
	// 	}
	// }
	
	// $dealtype=Deal::where('leadcode',$leadocde)->get(); 
	// //dd($dealtype);
	
	// if($status==1)
	// {
      		
 //      		return View('initiator/vipbooking')->with(array('lead_id'=>$lead_id,'dealtype'=>$dealtype));
      
 //      }
 // }
  
    
     
/**$lead_id=Deal::where('leadcode',$dealid)->get();
      return View('initiator/vipbooking')->with(array('lead_id'=>$lead_id));**/
      
      
	/**$status=0;
 	
	$lead_id=vipbooking::where('confirmation_code',$token)->get();
	
	foreach($lead_id as $lead){
		if($lead->confirmation_code==$token)
		{
			$status =1;
		}
	}
	
	if($status==1)
	{
      		 return View('initiator/editdeal')->with(array('lead_id'=>$lead_id));
      		 return View('initiator/home');
      
      }else
      	dd('ssss');**/

 public function postBookingform( Request $request){

 	$post = Input::get();
 	$email=Input::get('vip_email');
 	$clientname=Input::get('clientname');
 	$logo=Input::get('logo');
 	$leadcode=Input::get('leadid');
 	$dealid=Input::get('dealid');
 	 $confirmation_code = str_random(30);
 	 $fromemail=Input::get('fromemail');
 	 $empid=Input::get('empid');
 	 // dd($fromemail);
 	
 	$c= new vipbooking();
 	$c->email = $email;
 	$c->clientname = $clientname;
 	$c->empid = $empid;
 	$c->deal_id=$dealid;
	$c->leadcode=$leadcode;
	$c->confirmation_code  = $confirmation_code;
	$c->save();
	
	//update delegate deal info
	$i=delegatedealinfo::where('deal_id',$dealid)
	->update(array(
	'logo'=>$logo,
	
	'vip'=>'NULL'
	)
	);

	$deal=Deal::where('leadcode',$leadcode)->get();
	foreach ($deal as $key) {
		$event=$key->Eventname;
		$company=$key->Companyname;
	}
// dd($confirmation_code);

 	$subject =$event ."_"."Delegate"."Booking" ."Form"."_" . $company;
 		// dd($subject);
			Mail::send('emails.booking',['Booking'=>'sdsad'],function($message) use ($subject,$email,$fromemail ) {
			// note: if you don't set this, it will use the defaults from config/mail.php
			$message->from($fromemail,'IDE Consulting Services Pvt  Ltd');
			$message->to($email)

			->subject($subject);
	
			});

			$request->session()->flash('alert-success', 'VIP Booking Form has been sent to client');
			return redirect('initiator/pendingactivity');
 	}
// public function postInsertvipbookingform(VipRequest $request){
// 	//dd('dasd');
// 	$post = Input::get();

		
		
// 	$editleadid=Input::get('leadid');
// 		// dd($editleadid);
		
// 			$i=vipbooking::where('id',$editleadid)
// 		            ->update(array(
// 		'pname'=>$post['pname'],
// 		'ppassport'=>$post['ppassport'],
// 		'pemail'=>$post['pemail'],
// 		'pmobile'=>$post['pmobile'],
// 		'pdesg'=>$post['pdesg'],
// 		'sname'=>$post['sname'],
// 		'spassport'=>$post['spassport'],
// 		'semail'=>$post['semail'],
// 		'smobile'=>$post['smobile'],
// 		'sdesg'=>$post['sdesg'],
// 		'status'=>'NULL'
// 		)
//  );
// 		               if($i>0){
// 		$request->session()->flash('alert-success', 'Updated Successfully');
// 		return Redirect::back();

// 		}
		

// }
 public function postAccpetvip( Request $request){

 	$post = Input::get();
 	//dd($post);
 	$vipid=Input::get('accvipid');
 	$vip_id=Input::get('leadcode');

 	// $email=Input::get('email');
 	$status=Input::get('approve_status');
  $date = date('Y-m-d H:i:s');
 	// dd($date);
 	$i=vipbooking::where('id',$vipid)
		            ->update(array(
		
		'status'=>$status,
		'datetime'=>$date
		)
 );

$i=delegatedealinfo::where('leadcode',$leadcode)
	->update(array(
	
	'vip'=>$status
	)
	);

		$id=$vip_id;
		// dd($id);


		$vipdata=vipbooking::where('leadcode',$id)->where('id', DB::raw("(select max(`id`) from vipbooking)"))->get();
		$leadsheet=leadsheet::where('leadcode',$id)->get();
		$dealdata=Deal::where('leadcode',$id)->get();

		foreach($dealdata as $data){
			$event=$data->Eventcode;
		}
		$tenevent=Event::where('eventcode',$event)->get();
		
		$benefits=benefits::where('leadcode',$id)->get();

		foreach($dealdata as $deal)
{
	$company=$deal->Companyname;
	$event=$deal->Eventname;

}		
foreach($vipdata as $dat){
	$email=$dat->pemail;
} 	
$subject =$event ."_"."Delegate"."Booking" ."Form"."_" . $company;

		$html22 =  View('vipbookingform')->with(array('vipdata'=>$vipdata,'dealdata'=>$dealdata,'tenevent'=>$tenevent,'leadsheet'=>$leadsheet,'benefits'=>$benefits))->render();



			$html1 = "<h1>adsfadsfasdf</h1>";
			require_once(app_path().'/libs/html2pdf/html2pdf.class.php');


			$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

			// $html2pdf->pdf->SetDisplayMode('fullpage');

			$html2pdf->WriteHTML($html22);

			$htmltosend=$html2pdf->Output('','S');
			


		
			Mail::send('emails.approve',array('vipdata'=>$vipdata,'dealdata'=>$dealdata,'tenevent'=>$tenevent,'leadsheet'=>$leadsheet,'benefits'=>$benefits),function($message) use ($subject,$htmltosend,$email ) {
			// note: if you don't set this, it will use the defaults from config/mail.php
			$message->from('invoice@ide-global.com', 'IDE Consulting Services Pvt Ltd');
			$message->to($email)
			->subject($subject)
			->attachData($htmltosend,'Delegateconfirmationform.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
			});
			  if($i>0){

			$request->session()->flash('alert-success', 'Delegateconfirmationform has been sent to client !');
			return Redirect::back();

		}
			

			//$request->session()->flash('alert-success', 'VIP Booking Form has been sent to client');
			//return Redirect::back();
 	}
 	
 	public function postRejectvip( Request $request){

		$post = Input::get();
		//dd($post);
		$vipid=Input::get('rejid');
		$leadcode=Input::get('leadcode');
		$email=Input::get('email');
		$empid=Input::get('empid');
		$status=Input::get('reject_status');
		$rcm=Input::get('reject_comment');

		$empid=Employee::where('emp_ide_id',$empid)->get();
		foreach($empid as $email){
			$fromemail=$email->email;
		}

		$selectdata=vipbooking::where('id',$vipid)->get();
 	foreach($selectdata as $data){
 		$email=$data->email;
 		$empid=$data->empid;
 		$clientname=$data->clientname;
 		$leadcode=$data->leadcode;
 		$dealid=$data->deal_id;
 	}
 $confirmation_code = str_random(30);
 	$c= new vipbooking();
 	$c->email = $email;
 	$c->clientname = $clientname;
 	$c->empid = $empid;
 	$c->deal_id=$dealid;
	$c->leadcode=$leadcode;
	$c->confirmation_code  = $confirmation_code;
	$c->save();
		$i=vipbooking::where('id',$vipid)
		->update(array(

		'status'=>$status,
		'rcomments'=>$rcm
		)
		);
		$i=delegatedealinfo::where('leadcode',$leadcode)
		->update(array(

		'vip'=>'NULL'
		)
		);
		$getdetails=DB::table('deal')

		->join('vipbooking', 'deal.leadcode','=','vipbooking.leadcode')->where('deal.leadcode','=',$leadcode)->where('vipbooking.leadcode','=',$leadcode)
		->get();
		foreach($getdetails as $get){
		$sendemail=$get->pemail;
		}
		// dd($email);
		// dd($confirmation_code);
		$deal=Deal::where('leadcode',$leadcode)->get();
		foreach ($deal as $key) {
		$event=$key->Eventname;
		$company=$key->Companyname;
		}				

		$subject ="Rejection"."_".$event ."_"."Delegate"."Booking" ."Form"."_" . $company;
		Mail::send('emails.rejectmail',array('selectdata' => $selectdata),function($message) use ($subject,$email) {
		// note: if you don't set this, it will use the defaults from config/mail.php
		$message->from($fromemail, 'IDE Consulting Services Pvt Ltd');
		$message->to($email)

		->subject($subject);
		});

		$request->session()->flash('alert-success', 'Invoice has been sent to client !');
		return Redirect::back();

	
			

			//$request->session()->flash('alert-success', 'VIP Booking Form has been sent to client');
			//return Redirect::back();
 	}

 	 public function getVipbookingform($vip_id){



		$id=$vip_id;
		// dd($id);


		$vipdata=vipbooking::where('leadcode',$id)->where('id', DB::raw("(select max(`id`) from vipbooking)"))->get();
		$leadsheet=leadsheet::where('leadcode',$id)->get();
		$dealdata=Deal::where('leadcode',$id)->get();

		foreach($dealdata as $data){
			$event=$data->Eventcode;
		}
		$event=Event::where('eventcode',$event)->get();
		$benefits=benefits::where('leadcode',$id)->get();

		$html22 =  View('vipbookingform')->with(array('vipdata'=>$vipdata,'dealdata'=>$dealdata,'event'=>$event,'leadsheet'=>$leadsheet,'benefits'=>$benefits))->render();



		require_once(app_path().'/libs/html2pdf/html2pdf.class.php');





		$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));



		// $html2pdf->pdf->SetDisplayMode('fullpage');



		$html2pdf->WriteHTML($html22);



		$html2pdf->Output('Invoice.pdf');

        

      

    }

}