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

			<a id="newLog" class="btn-large teal modal-trigger log-actions" href="#newLogModal">Create New Log <i class="material-icons">add_circle</i></a>
			<div class="modal" id="newLogModal">
				<div id="newLogDetails" class="modal-content">
					
				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
				</div>
			</div>

			<a class="dropdown-trigger btn-large teal log-actions" href="#dropdownSort"><i class="material-icons">sort</i> Sort Timesheet</a>

			<ul id="dropdownSort" class="dropdown-content">
				<li>
					<a href="{{ url('/timesheet/sort-by-priority') }}">Sort by Priority <i class="material-icons">priority_high</i></a>
				</li>
				<li>
					<a href="{{ url('/timesheet/sort-by-name') }}">Sort by Name <i class="material-icons">person</i></a>
				</li>
				<li>
					<a href="{{ url('/timesheet/sort-by-job') }}">Sort by Job <i class="material-icons">build</i></a>
				</li>
				<li>
				<a href="{{ url('/timesheet/sort-by-date') }}">Sort by Date <i class="material-icons">date_range</i></a>
				</li>
			</ul>

		<form action="{{ url('/timesheet/multi-delete') }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('delete') }}
			<table id="logsTable" class="responsive-table centered striped highlight">
				<thead>
					<th><button type="submit" class="btn-small red darken-4 waves-effect">
							<i class="material-icons">delete_forever</i>
						</button>
					</th>
					<th>Name</th>
					<th>Job</th>
					<th>Date</th>
					<th>Clock In</th>
					<th>Clock Out</th>
				</thead>
				<tbody>
				@foreach($logs as $timesheet)
					<tr id="row{{ $timesheet->id }}" class="timesheet-row">
						<td><label>
								<input type="checkbox" name="deleteLogs[]" value="{{ $timesheet->date.$timesheet->clock_in.$timesheet->clock_out }}" required>
								<span class="invisible-text">{{ $timesheet->id }}</span>
							</label>
						</td>
						<td>{{ $timesheet->employee->name }}</td>
						<td>{{ $timesheet->job->job }}</td>
						<td >{{ $timesheet->date }}</td>
						<td>{{ $timesheet->clock_in }}</td>
						@if ($timesheet->clock_out == null)
						<div class="clock-out">
						<td><button class="btn teal modal-trigger clock-out-btn" href="#clockOutModal" value="{{ $timesheet->id }}">Clock Out</button></td>
						</div>
						
						@else
						<td>{{ $timesheet->clock_out }}</td>
						@endif
					</tr>
					
				@endforeach
				</tbody>
			</table>
		</form>

		<div class="modal" id="clockOutModal">
			<div id="clockOutDetails" class="modal-content">
				
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
			$('.dropdown-trigger').dropdown();

		});

		$('.clock-out-btn').on('click', function() {
			var logID = $(this).val();
			// alert(logID);
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

		$('.timesheet-row').on('click', function() {
			var id = $(this).attr('id');
			id = id.replace("row", "");
			// alert(id);
			$('#deleteBtn' + id).toggle();
		});

		$(function() {
            var requiredCheckboxes = $(':checkbox[required]');

            requiredCheckboxes.change(function(){
                if(requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });
	</script>
@endsection