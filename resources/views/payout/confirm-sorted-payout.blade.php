{{-- <h5 id="confirmPayoutTitle" class="indigo-text">Confirm Payout</h5>
<form method="POST" id="payment-form"  action={{ url('payout/send-via-paypal') }}>
	{{ csrf_field() }}
	<div class="row">
		<div class="input-field col s12">
			@foreach ($payout as $payout)
			<input hidden name="payout_id" value="{{ $payout->id }}">
			<input type="text" id="amountInput" name="amount" value="$ {{ $payout->wage }}" readonly>
			<label id="amountLabel" class="active teal-text" for="amount">Amount to Pay:</label>
			@endforeach
		</div>     
		<div id="payout-actions" class="center">
			<button type="submit" class="btn payout-option white blue-text">
				<img id="paypalLogo" src="{{ asset('img/paypal.png') }}" alt="Pay with PayPal">
			</button>
		</div>
	</div>
</form> --}}

<h5 id="confirmPayoutTitle" class="indigo-text">Confirm Payout</h5>
<form method="POST" id="payment-form"  action={{ url('payout/update-status') }}>
	{{ csrf_field() }}
	<div class="row">
		<div class="input-field col s12">
			@foreach ($payout as $payout)
			<input hidden name="payout_id" value="{{ $payout->id }}">
			<input type="text" id="amountInput" name="amount" value="$ {{ $payout->wage }}" readonly>
			<label id="amountLabel" class="active teal-text" for="amount">Amount to Pay:</label>
			@endforeach
		</div>     
		<div id="payout-actions" class="center">
			<button type="submit" class="btn payout-option">Mark as Released</button>
		</div>
	</div>
</form>
