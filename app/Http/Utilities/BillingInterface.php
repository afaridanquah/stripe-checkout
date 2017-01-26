<?php
namespace App\Http\Utilities;

interface BillingInterface {
	public function charge(array $data);
}