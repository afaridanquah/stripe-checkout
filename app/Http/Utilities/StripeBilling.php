<?php 
namespace App\Http\Utilities;


use Stripe\Stripe;
use Stripe\Charge;
use Stripe_CardError;
use \Stripe\Customer;
use Config;

class StripeBilling implements BillingInterface{

	public function __construct()
	{
	
		// \Stripe\Stripe::setApiKey("sk_test_8VciQSlC5hVfemLpGJC647zv");
		\Stripe\Stripe::setApiKey(Config::get('stripe.secret_key'));
		
	}

	public function charge(array $data)
	{
		try {
			$customer = \Stripe\Customer::create([
				'card' =>$data['token'],
				'description' =>$data['email']

				]);


			 \Stripe\Charge::create([
				'customer'=> $customer->id,
				'amount'=>1000,
				'currency' => 'usd',
			]);
			 return $customer->id;
		} catch (\Stripe\Error\Card $e) {
				dd('card was declined');
		}

		
	}
}