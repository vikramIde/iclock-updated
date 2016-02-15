<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix'=>'api/v1/'],function(){
	 
	 Route::resource('events','EventsapiController');
});

Route::get('/', function () {
	if(empty(Auth::user()->name))
		return view('welcome');
		else
		{
			if(Auth::user()->role =='admin1')
				return redirect('executor/home');
			if(Auth::user()->role =='admin2')
				return redirect('reviewer/home');
			if(Auth::user()->role =='collector')
				return redirect('collection/home');
			if(Auth::user()->role =='sales')
				return redirect('initiator/home');
			if(Auth::user()->role =='director')
				return redirect('approval/home');
			
		}
});

Route::controllers([
	'auth'=>'Auth\AuthController',
	'password'=>'Auth\PasswordController',
]);

//jeevan module
Route::controller('executor', 'ExecutorController');

//sam module
Route::controller('reviewer','ReviewerController');

//manju module
Route::controller('collection','CollectionController');

//sales module
Route::controller('initiator','InitiatorController');

//admin module
Route::controller('approval','ApprovalController');
//POST route
Route::post('home', 'LoginController@postLogin');

Route::get('resetpass','AddUserController@getResetpass');
Route::post('/reset','AddUserController@postReset');



Route::get('collection', function () {
   return Redirect::to('/');
});
Route::get('collection/home', function () {
   return Redirect::to('/');
});

Route::get('main/logout',function(){
	Session::flush();
	Auth::logout();
	session()->flash('alert-success', 'Success logged out');
	return Redirect::to('/');
});
