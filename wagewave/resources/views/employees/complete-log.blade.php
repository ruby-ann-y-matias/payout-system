<div class="row">
	<form action={{ url('/timesheet/late-log-out') }} method="POST">
		{{ csrf_field() }}
		<div class="input-field col s12 grey lighten-3">
			<input type="text" id="name" value="{{ $timesheet->employee->name }}" readonly>
			<label class="active teal-text" for="name">Employee Name:</label>
		</div>
		<div class="input-field col s12 grey lighten-3">
			<input type="text" id="job" value="{{ $timesheet->job->job }}" readonly>
			<label class="active teal-text" for="job">Job Title:</label>
		</div>
		<div class="input-field col s12 grey lighten-3">
			<input type="time" id="clock_in" value="{{ $timesheet->clock_in }}" readonly>
			<label class="active teal-text" for="clock_in">Time In:</label>
		</div>

		<div class="input-field col s12">
			<select id="dateOut" name="date_out" required>
				<option selected>{{ $timesheet->date }}</option>
				<option>{{ $max_date }}</option>
			</select>
			<label class="teal-text">Date of Clock Out:</label>
		</div>
		<div class="input-field col s12">
			<input type="time" id="clock_out" name="clock_out" value="{{ $timesheet->clock_out }}" min="{{ $min_time }}" required>
			<label class="active teal-text" for="clock_out">Time Out:</label>
		</div>
		{{-- <div class="input-field col s12">
			<input type="datetime-local" id="timeOut" name="clock_out" min="{{ $minimum }}" max="{{ $maximum }}" class="validate" required>
			<label class="active teal-text" for="timeOut">Time Out: </label>
		</div> --}}
		<meta name="start_date" content="{{ $timesheet->date }}">
		<meta name="start_time" content="{{ $timesheet->clock_in }}">
		<input hidden type="number" name="timesheet_id" value="{{ $timesheet->id }}">
		<button type="submit" id="lateLogOutBtn" class="waves-effect btn teal right" type="submit">Clock Out</button>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').formSelect();
	});

	$('#dateOut').on('change', function() {
		var startDate = $('[name="start_date"]').attr('content');
		var startTime = $('[name="start_time"]').attr('content');
		var selectedDate = $('#dateOut').val();
		// alert(startDate);
		// alert(startTime);
		if (startDate != selectedDate) {
			$('#clock_out').removeAttr('min');
			$('#clock_out').attr('max', startTime);
		}
	});
</script>