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
use Validator;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 use ViewinvoiceTrait;
 use ExchangerateTrait;
 
  public function __construct(){

}

  public function getIndex(){

    return redirect('collection/home');   
}

public function autocomplete(){
	
	dd(Input::get('companyName'));
	
	if(Input::get('companyName')){

		$term = Input::get('term');
		$results = array();
		
		$queries = \DB::table('emp_table')
			->where('emp_name', 'LIKE', '%'.$term.'%')
			->take(5)->get();
		
		foreach ($queries as $query){
			$results[] = [ 'id' => $query->id, 'value' => $query->company_name ];
		}
	return \Response::json($results);
	}

	if(Input::get('employeeName')){
		dd('lkhkhlk');
		$term = Input::get('term');
		$results = array();
		
		$queries = \DB::table('emp_table')
			->where('emp_name', 'LIKE', '%'.$term.'%')
			->where('emp_status','=','Active')->take(5)->get();
		
		foreach ($queries as $query){
			$results[] = [ 'id' => $query->emp_id, 'value' => $query->emp_name];
		}
		dd('sss');
	return \Response::json($results);
	}
	else
	{
		
	}
}

 }
