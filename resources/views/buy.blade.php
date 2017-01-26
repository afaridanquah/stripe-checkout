@extends('default')

@section('content')

<h1>Buy for $10</h1>

{{ Form::open(['id'=>'billing-form']) }}

	<div class="form-row">
		<label>
			<span> Card Number :</span>
			<input type="text"  data-stripe="number">
		</label>
	</div>

	<div class="form-row">
		<label>
			<span> CVC :</span>
			<input type="text"  data-stripe="cvc">
		</label>
	</div>


	<div class="form-row">
		<label>
			<span> Email</span>
			<input type="email"  name="email" id="email">
		</label>
	</div>

	<div class="form-row">
		<label>
			<span> Expiration Date :</span>
			{{ Form::selectMonth(null,null, ['data-stripe' =>'exp_month']) }}
			{{ Form::selectYear(null, date('Y') , date('Y') + 10,null, ['data-stripe' => 'exp_year']) }}
		</label>
	</div>

	<div class="form-group">
		{{ Form::submit('Buy New ')}}

	</div>
	<div class="payment-errors"></div>


{{ Form::close() }}


@endsection


@section('footer')

{{ Html::script('js/billing.js') }}

@endsection