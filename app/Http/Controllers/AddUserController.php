<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Event;
use App\User;
//use App\Employee;
//use App\Invoice;
use App\Adduser;
use Hash;
use Mail;

class AddUserController extends Controller
{
   public function getIndex(){
      return View('targetmodule/adduser');
    }
    
    public function postUser(Request $request)
    {
				  $rules = array(
				  
							'name' 		=> 'required|max:255',
							'email' 	=> 'required|email|max:255|unique:users',
							'password'	=> 'required|confirmed|min:6',
							'empid'		=>'required'
						

				  );

					$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails())
				{
					return redirect('targetmodule/adduser')->withErrors($validator);
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
					$data=array();
				   Mail::send('emails.verify', $data, function ($message) {

					$message->from('info@ide-global.com', 'Ide Global');

					$message->to('harshithak61@gmail.com','dsfsd')->subject('Login Credentials for iclock.in');

				});


					$request->session()->flash('alert-success', 'User added!');
				  return redirect('targetmodule/adduser');
				}



    }

    public function getResetpass( Request $request){

            return view('resettargetpassword');
	}
	
   public function postReset( Request $request ) {
        
	     $post = Input::get();
     
          //$cpass=\Hash::make( $post['currentpassword']);
		  
          $uservarr=User::where('id',$post['userid'])->get();
          foreach ($uservarr as $uemail) {
          	$email=$uemail['email'];
          	$name=$uemail['name'];
          	# code...
          }
          // dd($email);

          if (Hash::check($post['currentpassword'], $uservarr[0]->password))
			{
					// The passwords match...
					$rules = array(
					  'npassword' 		=> 'required',
					  'currentpassword' => 'required'
				  );
			  
			      $validator = Validator::make(Input::all(), $rules);

					if ($validator->fails())
					{
						
						return view('resettargetpassword')->withErrors($validator);
					}
					else
					{
						
						  $pass=\Hash::make( $post['npassword']);
						  
						  $i=User::where('id',$post['userid'])
							  ->update(array(
								'password' => $pass)
							  );
							  if($i>0){
								  $data=array();
								  
								    Mail::send('emails.reset', $data, function ($message) use ($email,$name) {

									$message->from('info@ide-global.com', 'Ide Global');
									//$message->to('vikrambanand@gmail.com','dsfsd')->subject('Password reset for iclock.in');
									$message->to($email,$name)->subject('The password has been reseted perfectly');

								});
										
								$request->session()->flash('alert-success', 'Updated Success!');
								return view('resettargetpassword');

							}

						
					}
				  
				}
				else 
					return view('resettargetpassword')->withErrors('Current Password does not match');
     
}

}