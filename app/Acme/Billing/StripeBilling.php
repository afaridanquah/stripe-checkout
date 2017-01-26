<?php 
namespace Acme\Billing;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Error\Card;
use Config;

class StripeBilling implements BillingInterface{

	public function __construct()
	{
	
		// \Stripe\Stripe::setApiKey("sk_test_8VciQSlC5hVfemLpGJC647zv");
		Stripe::get(Config::get('stripe.secret_key'));
		
	}

	public function charge(array $data)
	{
		try {
			return Charge::create([
			'amount'=>1000,
			'currency' => 'usd',
			'description' => $data['email'],
			'card' => $data['stripeToken']

			]);
		} catch (\Stripe\Error\Card) $e) {
			dd('card was declined');
		}
		
	}
}