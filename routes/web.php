<?php
use Illuminate\Support\Facades\Input;

App::bind('App\Http\Utilities\BillingInterface', 'App\Http\Utilities\StripeBilling');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buy', function(){
	return view('buy');
});

Route::post('/buy',function(){
	$billing = App::make('App\Http\Utilities\BillingInterface');
	$customer_id = $billing->charge([
			'email' => Input::get('email'),
			'token' => Input::get('stripeToken')
			]);
	$user = App\User::first();
	$user->billing_id = $customer_id;
	$user->save();

	return 'Charge was successful';
});


// Route::post('/buy', function (){
// 	dd(Input::all());
// });
