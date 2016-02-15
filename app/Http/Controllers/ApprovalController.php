<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Deal;
use Session;
use Validator;
use App\Employee;
use App\Event;
use App\Targetassign;

class ApprovalController extends Controller
{
  public function __construct(){

    $this->middleware('role:director'); // replace 'collector' with whatever role you need.
}
public function getIndex(){
	
                
            return redirect('approval/home');
 }

    public function getHome(){

         $employee = Employee::all();
      
      return View('approval/home')->with(array('employee'=>$employee));
    }


   public function postAddemployee( Request $request ) {
			$rules = array(
			    'empname'=>'required',
			    'empid'=>'required',
			    'emppos'=>'required',
			    'empdept'=>'required'

			  );

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails())
			{
			return redirect('approval/home')->withErrors($validator);
			}else {
			$data = Input::get();


			$c= new Employee();

			$c->emp_name = $data['empname'];
			$c->emp_ide_id = $data['empid'];
			$c->emp_position = $data['emppos'];
			$c->emp_department  = $data['empdept'];

			$c->save();



			}   
			$request->session()->flash('alert-success', 'Target Has Been Assigned Successfully');
			return redirect('approval/home');
			// 
    
}

 public function getAssigntarget(){

		                  $employee = Employee::all();
		                  $categories = Event::all();

		                  $userdetails = User::all();
		                  $targets = Targetassign::all();
		                  $deals = Deal::all();
		                  $userData = array();
		                  $key = 0 ;

		foreach ($targets as $target) {

		                    $achieved = 0;
		                    $userData[$key]['eventcode']=$target->Eventcode;  
		                    $userData[$key]['event']=$target->Eventname;
		                    $userData[$key]['employee']=$target->Employeeid;


		                    $userData[$key]['targetVal']=$target->Targetvalue;
		                     foreach ($deals as $deal) {
		        
		                                      if($target->Eventcode == $deal->Eventcode && $target->Employeeid==$deal->Empid)
		                                      {
		                                          $achieved = $achieved+$deal->Dealvalue;

		                                      }
		                    }

		                              $userData[$key]['achieved']=$achieved;
		                              $userData[$key]['variance']=$achieved-$target->Targetvalue;
		                              $userData[$key]['cur']= $target->Currency;
		                              $key++; 
		}
		      
		      return View('approval/assigntarget')->with(array('categories'=>$categories,'employee'=>$employee,'userdata'=>$userData,'targets'=>$targets,'eventtable'=> $categories ));
    }
public function postTargetassign( Request $request ) {

			$rules = array(
			'employeeid'=>'required',
			'eventname'=>'required',
			'target_value'=>'required',
			'target_date'=>'required',
			'currency'=>'required',
			'modeoftarget'=>'required'

			);

			$validator = Validator::make(Input::all(), $rules);


			if ($validator->fails())
			{
			return redirect('approval/assigntarget')->withErrors($validator);
			}else {
			$data = Input::get();
			$employeeid=Input::get('employeeid');
			$result=(explode('|', $employeeid, 2));
			$empid=trim($result[0]);
			$empname=trim($result[1]);

			$eventcode=Input::get('eventname');
			$res=(explode('|', $eventcode, 2));
			$eventcode=trim($res[0]);
			$eventname=trim($res[1]);
			
			$now=date('d-m-Y');


			$targetdata=Targetassign::where('Eventname',$data['eventname'])->where('Employeeid',$data['employeeid'])->get();


			// dd(count($targetdata)) ;
			if(count($targetdata)==0){
			$c= new Targetassign();

			$c->Employeeid = $empid;
			$c->Empname = $empname;
			$c->Eventcode  = $eventcode;
			$c->Eventname  = $eventname;
			$c->Targetvalue = $data['target_value'];
			$c->Currency  = $data['currency'];
			$c->Targetdate  = $data['target_date'];
			$c->Targetassigned=$now;

			$c->Modeoftarget  = $data['modeoftarget'];

			$c->save();

			}
			else
			{
			return redirect('approval/assigntarget')->with('target_error',true);

			}




			}   
			$request->session()->flash('alert-success', 'Target Has Been Assigned Successfully');
			return redirect('approval/assigntarget');
        // 
    
}
 public function postUpdatetargetassign( Request $request ) {

			$tid=Input::get('targetid');


			$now=date('d-m-Y');

			$post = Input::get();
			$i=Targetassign::where('Id',$tid)
			->update(array(
			'Targetvalue' => $post['targetvalue'],
			'Targetdate' => $post['duedate'])
			);
			if($i>0){
			$request->session()->flash('alert-success', 'Target Has Been Updated Successfully');
			return redirect('approval/assigntarget');

			}
 }


 public function getAdduser(){

      			return View('approval/adduser');
 }

public function postUser(Request $request){

			$rules = array(
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'empid'=>'required'


			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails())
			{
			return redirect('approval/adduser')->withErrors($validator);
			}else {

			$data = Input::get();
			$role='sales';


			User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role' => $role,
			'empid' => $data['empid'],
			]);
			// $data=array();
			// Mail::send('emails.verify', $data, function ($message) {

			// $message->from('info@ide-global.com', 'Ide Global');

			// $message->to('harshithak61@gmail.com','dsfsd')->subject('Login Credentials for iclock.in');

			// });


			$request->session()->flash('alert-success', 'User added!');
			return redirect('approval/adduser');
    }



    }

       public function postUpdateadmin( Request $request) {

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
			return redirect('approval/home');

			}

    
}


}