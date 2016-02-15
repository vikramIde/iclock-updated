<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;
use Validator;

class LoginController extends Controller
{

    public function getLogin(){
        return View::make('welcome');
    }
 
   
    public function postLogin(){

         $rules = array(
        
     'empid'=>'required',
      'password'=>'required'
     
      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('/')->withErrors($validator);
    }else {

        $cred = array(
                'empid' => Input::get('empid'),
                'password' => Input::get('password')
            );
          $role = User::where('empid','=',Input::get('empid'))->first();
  
        if (Auth::attempt($cred) && $role->role == 'super admin'){
            if (Auth::check()){
                Session::put('role','super admin');
                Session::put('name',Auth::user()->name);
               return redirect('home');
            }
            
        } 
        else 
        if (Auth::attempt($cred) && $role->role == 'admin1'){
            if (Auth::check()){
                Session::put('role','admin1');
                Session::put('name',Auth::user()->name);
                return redirect('executor/home');
            }
           
        } 
        else 
        if (Auth::attempt($cred) && $role->role == 'admin2'){
            if (Auth::check()){
                Session::put('role','admin2');
                Session::put('name',Auth::user()->name);
                 return redirect('reviewer/home');
            }
            
        } 
        else 
        if (Auth::attempt($cred) && $role->role == 'collector'){
            if (Auth::check()){
                        Session::put('role','collector');
                        Session::put('name',Auth::user()->name);
                        return redirect('collection/home');
            }
            
        }  
        else 
        if (Auth::attempt($cred) && $role->role == 'crmadmin'){
            if (Auth::check()){
                Session::put('role','crmadmin');
                Session::put('name',Auth::user()->name);
              return redirect('crm/home');
            }
            
        } 
         else 
        if (Auth::attempt($cred) && $role->role == 'sales'){
            if (Auth::check()){
                Session::put('role','sales');
                Session::put('name',Auth::user()->name);
              return redirect('initiator/home');
            }
            
        } 
        else 
        if (Auth::attempt($cred) && $role->role == 'marketing'){
            if (Auth::check()){
                Session::put('role','marketing');
                Session::put('name',Auth::user()->name);
              return redirect('marketing/home');
            }
            
        } 

        else 
        if (Auth::attempt($cred) && $role->role == 'director'){
            if (Auth::check()){
                Session::put('role','director');
                Session::put('name',Auth::user()->name);
                return redirect('approval/home');
            }
            
        } 

        else{
                Session::flush();
                Auth::logout();
                 return redirect('/')->with('login_errors',true);
            }
    }

    }
}