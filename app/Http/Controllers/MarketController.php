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
use App\User;
use App\Deal;
use App\delegateinfo;
use App\Invoice;
use App\Employee;
use App\leadsheet;
use App\Targetassign;
use App\callback;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Event;
use DB;
use Session;
use Validator;

class MarketController extends Controller
{
   
 
 public function getIndex(){

       
            return redirect('marketing/home');
 }

 public function getHome(){
                
                 $empid= Auth::user()->empid;
                $emp=Employee::where('emp_ide_id',$empid)->get();
                return View('marketing/home')->with(array('emp'=>$emp));
 }

 public function getLeadsheet(){
    $varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
             $edetails=Employee::where('emp_ide_id',$varr)->get();
           $leads=leadsheet::where('empid',$varr)->where('callback','=','0')->where('followup','=','0')->where('reassignedId','=','0')->where('dealclose','=','')->where('blowout','=','')->get();
       $assignedme = leadsheet::where('reassignedId',$varr)->where('reassigned','=',1)->get(); 
       $salesman_list = Employee::where('cat','=','Management')->where('emp_status','=','Active')->get();
      
        
      return View('marketing/leadsheet')->with(array('evarr'=>$evarr,'assignedme'=>$assignedme,'leads'=>$leads,'salesman_list'=>$salesman_list,'edetails'=>$edetails));
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
        if($variable=='Marketing'){
            $leadcode='ML';
            $count = leadsheet::where('leadcat','=','Marketing')->count();
            $counti = str_pad($count+1, 5, '0', STR_PAD_LEFT);
                         $leadc=$leadcode.''.$year.''.$counti;
                // dd($leadc);

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
        return redirect('marketing/leadsheet');
        // 

 }

  public function getEditlead($leadid){
    $lead_id=leadsheet::where('id',$leadid)->get();
      return View('marketing/editlead')->with(array('lead_id'=>$lead_id));
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
        return redirect('marketing/leadsheet');

        }
        
    
 }
  public function postReassignlead(Request $request){
            $updateLead = Input::get();
            $eid=Input::get('assignedid');
        $result=(explode('|', $eid, 2));
        $emid=trim($result[0]);
        $ename=trim($result[1]);
            if(!empty($updateLead['assignedid'])){
                
                $lead = leadsheet::find($updateLead['leadid']);
                $lead->reassigned =1;
                $lead->reassignedId =$emid;
                $lead->reassignedempname =$ename;
                
            
                $lead->save();
                
                }
                $request->session()->flash('alert-success', 'Comment inserted Successfully');
                return redirect('marketing/leadsheet');
 }
  public function getDealclose(){
    $varr= Auth::user()->empid;
    $edetails=Employee::where('emp_ide_id',$varr)->get();
    $lead_id=leadsheet::where('blowout','=','1')->where('empid',$varr)->get();
    $dealclose=leadsheet::where('dealclose','=','1')->where('empid',$varr)->get();
      return View('marketing/dealclose')->with(array('lead_id'=>$lead_id,'dealclose'=>$dealclose,'edetails'=>$edetails));
}
 public function getLeadstatus(){
    $varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
             $edetails=Employee::where('emp_ide_id',$varr)->get();
             $mleads=leadsheet::where('leadcat','=','Marketing')->get();
      return View('marketing/leadstatus')->with(array('edetails'=>$edetails,'mleads'=>$mleads));
}
 public function getViewlead($leadid){
    $varr= Auth::user()->empid;
           $evarr=User::where('empid',$varr)->get();
             $edetails=Employee::where('emp_ide_id',$varr)->get();
             $mleads=leadsheet::where('leadcat','=','Marketing')->where('id',$leadid)->get();
             $leadscallback=callback::where('leadid',$leadid)->get();
      return View('marketing/viewlead')->with(array('edetails'=>$edetails,'mleads'=>$mleads,'leadscallback'=>$leadscallback));
}
}
