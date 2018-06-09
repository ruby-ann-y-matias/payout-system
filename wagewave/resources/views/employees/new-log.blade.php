<form action={{ url('/timesheet/save-log') }} method="POST">
		{{ csrf_field() }}
	<div class="row">
		<div class="input-field col s12">
			<select name="employee_id" required>
				<option selected disabled>Select employee's name</option>
				@foreach($employees as $employee)
				<option value="{{ $employee->id }}">{{ $employee->name }}</option>
				@endforeach
			</select>
			<label class="teal-text">Employee's Name:</label>
		</div>
		<div class="input-field col s12">
			<select name="job_id" required>
				<option selected disabled>Select job title</option>
				@foreach($jobs as $job)
				<option value="{{ $job->id }}">{{ $job->job }}</option>
				@endforeach
			</select>
			<label class="teal-text">Job Title:</label>
		</div>
		
		<div class="input-field col s12">
			<input type="date" id="dateIn" name="date">
			<label class="active teal-text" for="dateIn">Date In:</label>
		</div>
		<div class="input-field col s12">
			<input type="time" id="clockIn" name="clock_in">
			<label class="active teal-text" for="clock_in">Time In:</label>
		</div>
		
		<div class="input-field col s12">
			<input type="date" id="dateOut">
			<label class="active teal-text" for="dateOut">Date Out:</label>
		</div>
		<div class="input-field col s12">
			<input type="time" id="clockOut" name="clock_out">
			<label class="active teal-text" for="clockOut">Time Out:</label>
		</div>

		{{-- <div class="input-field col s12">
			<input type="datetime-local" id="timeOut" name="clock_out" min="{{ $minimum }}" max="{{ $maximum }}" class="validate" required>
			<label class="active teal-text" for="timeOut">Time Out: </label>
		</div> --}}
		<button type="submit" id="saveNewLog" class="waves-effect btn green accent-5 right add-submit" type="submit">Save</button>
		<button type="button" class="waves-effect btn deep-orange darken-3 right cancel-new-addition modal-close">Cancel</button>
	</div>
</form>


<script type="text/javascript">
	$(document).ready(function() {
		$('select').formSelect();
	});

	// $('#dateOut').on('change', function() {
	// 	var startDate = $('[name="start_date"]').attr('content');
	// 	var startTime = $('[name="start_time"]').attr('content');
	// 	var selectedDate = $('#dateOut').val();
	// 	// alert(startDate);
	// 	// alert(startTime);
	// 	if (startDate != selectedDate) {
	// 		$('#clock_out').removeAttr('min');
	// 		$('#clock_out').attr('max', startTime);
	// 	}
	// });
</script>