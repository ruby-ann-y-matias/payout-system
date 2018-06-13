@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/payout') }}">Payout</a>
        </div>
    </nav>
@endsection

@section('content')

	<div class="container">
		
		@if (!$payout->isEmpty())

			<a class="dropdown-trigger btn-large teal log-actions" href="#dropdownSort"><i class="material-icons">sort</i> Sort Payout {{ $criteria }}</a>

			<h4 class="paid-total-info right"><small>Total Paid Wages:</small> ${{ $paid_total }}</h4>

			<ul id="dropdownSort" class="dropdown-content">
				<li>
					<a href="{{ url('/payout/sort-by-priority') }}">Sort by Priority <i class="material-icons">priority_high</i></a>
				</li>
				<li>
					<a href="{{ url('/payout/sort-by-name') }}">Sort by Name <i class="material-icons">person</i></a>
				</li>
				<li>
					<a href="{{ url('/payout/sort-by-job') }}">Sort by Job <i class="material-icons">build</i></a>
				</li>
				<li>
				<a href="{{ url('/payout/sort-by-date') }}">Sort by Date <i class="material-icons">date_range</i></a>
				</li>
				<li>
				<a href="{{ url('/payout/sort-by-hours') }}">Sort by Hours <i class="material-icons">timer</i></a>
				</li>
				<li>
				<a href="{{ url('/payout/sort-by-wage') }}">Sort by Wage <i class="material-icons">payment</i></a>
				</li>
			</ul>

			<table id="logsTable" class="responsive-table centered striped highlight">
				<thead>
					<th>Name</th>
					<th>Job</th>
					<th>Date</th>
					<th>Hours</th>
					<th>Wage</th>
					<th>Status</th>
				</thead>
				<tbody>
				@foreach($payout as $wage)
					<tr>
						<td>{{ $wage->employee->name }}</td>
						<td>{{ $wage->job->job }}</td>
						<td >{{ $wage->date }}</td>
						<td>{{ $wage->hours }}</td>
						<td><strong>$</strong> {{ $wage->wage }}</td>
						@if ($wage->status->status == 'pending')
						<td><button class="btn teal modal-trigger pay-now-btn" href="#payoutModal" value="{{ $wage->id }}">Pay Now</button></td>
						@else
						<td>{{ $wage->status->status }}</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>

			<div class="modal" id="payoutModal">
				<div id="payoutModalContent" class="modal-content">
					
				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
				</div>
			</div>

		@else

		<div class="empty-container">
			<h5 class="empty-msg center-align indigo-text">No payout found.</h5>
		</div>

		@endif

	</div>

@endsection

@section('indiv_js')
	<script type="text/javascript">

		$(document).ready(function() {
			$('.modal').modal();
			$('.dropdown-trigger').dropdown();
		});

		$('.pay-now-btn').on('click', function() {
			var wageID = $(this).val();
			var csrf = $('[name="csrf-token"]').attr('content');
			// console.log(csrf);
			// console.log(wageID);
			$.post('/confirm-payout/',
				{
					wage_id: wageID,
					_token: csrf
				},
				function(data, status) {
					$('#payoutModalContent').html(data);
				});
		});

	</script>
@endsection