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
use App\crmteamname;
use App\Employee;

class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){

    return redirect('crm/home');   
}

  public function getHome(){

    
    
    return View('crm/home');
   
 }
public function getAddteam(){

    $teamnames=crmteamname::all();
    $empdet=Employee::where('emp_department','=','CRM')->get();
    
    return View('crm/addteam')->with(array('empdet'=>$empdet,'teamnames'=>$teamnames));
   
 }
public function postCreateteam(Request $request){
   $data = Input::get();

            for($i = 0; $i < count($data['teamname']); $i++) {
            $c= new crmteamname();

            $c->teamname = $data['teamname'][$i];
           
             $c->save();
                 
             }
            
       
    
               $request->session()->flash('alert-success', 'Success');
              return redirect('crm/addteam');
 

 }
}
