@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/timesheet') }}">Timesheet</a>
        </div>
    </nav>
@endsection

@section('content')

	<div class="container">
		
		@if (!$logs->isEmpty())

			<table id="logsTable" class="responsive-table centered striped highlight">
				<thead>
					<th>Name</th>
					<th>Job</th>
					<th>Date</th>
					<th>Clock In</th>
					<th>Clock Out</th>
				</thead>
				<tbody>
				@foreach($logs as $timesheet)
					<tr>
						<td>{{ $timesheet->employee->name }}</td>
						<td>{{ $timesheet->job->job }}</td>
						<td >{{ $timesheet->date }}</td>
						<td>{{ $timesheet->clock_in }}</td>
						@if ($timesheet->clock_out == null)
						<div class="clock-out">
						<td><button class="btn teal modal-trigger" href="#clockOutModal" id="clockOut" value="{{ $timesheet->id }}">Clock Out</button></td>
						</div>
						<div class="modal" id="clockOutModal">
							<div id="clockOutDetails" class="modal-content">
								
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
							</div>
						</div>
						<td id="missingLog" hidden></td>
						@else
						<td>{{ $timesheet->clock_out }}</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>

			<a id="newLog" class="btn-large teal modal-trigger" href="#newLogModal">Create New Log</a>
			<div class="modal" id="newLogModal">
				<div id="newLogDetails" class="modal-content">
					
				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
				</div>
			</div>

		@else

		<div class="empty-container">
			<h5 class="empty-msg center-align indigo-text">No records found.</h5>
			<a id="newLog" class="btn-large teal modal-trigger" href="#newLogModal">Log Now</a>
			<div class="modal" id="newLogModal">
				<div id="newLogDetails" class="modal-content">
					
				</div>
			</div>

		</div>

		@endif

	</div>

@endsection

@section('indiv_js')
	<script type="text/javascript">

		$(document).ready(function() {
			$('.modal').modal();
		});

		$('#clockOut').on('click', function() {
			var logID = $(this).val();
			// alert(empID);
			// alert(csrf);

			$.get('/timesheet/complete-log/' + logID,
				{
					// 
				},
				function(data, status) {
					$('#clockOutDetails').html(data);
				});
		});

		$('#newLog').on('click', function() {
			$.get('/timesheet/new-log',
				{
					// 
				},
				function(data, status) {
					$('#newLogDetails').html(data);
				});
		});
	</script>
@endsection