<form id="newLogForm" action={{ url('/timesheet/save-log') }} method="POST">
	{{ csrf_field() }}
	<div class="row">
		<div class="input-field col s12">
			<select name="employee_id" aria-required="true" required>
				<option value="">Select employee's name</option>
				@foreach($employees as $employee)
				<option value="{{ $employee->id }}">{{ $employee->name }}</option>
				@endforeach
			</select>
			<label class="teal-text">Employee's Name:</label>
		</div>
		<div class="input-field col s12">
			<select name="job_id" aria-required="true" required>
				<option value="">Select job title</option>
				@foreach($jobs as $job)
				<option value="{{ $job->id }}">{{ $job->job }}</option>
				@endforeach
			</select>
			<label class="teal-text">Job Title:</label>
		</div>
		
		<div class="input-field col s12">
			<input type="text" class="datepicker" id="startDate" name="start_date" required>
			<label class="active teal-text" for="dateIn">Start Date:</label>
		</div>
		<div class="input-field col s12">
			<input type="text" class="timepicker" id="timeIn" name="clock_in" required disabled>
			<label class="active teal-text" for="clock_in">Time In:</label>
		</div>

		<div class="input-field col s12">
			<input type="text" class="datepicker" id="endDate" name="end_date" required disabled>
			<label class="active teal-text" for="dateIn">End Date:</label>
		</div>
		<div class="input-field col s12" required>
			<input type="text" class="timepicker" id="timeOut" name="clock_out" required disabled>
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
		$('#startDate').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('.timepicker').timepicker({
			// twelveHour: false
		});
	});

	$('#startDate').on('change', function() {
		$('#timeIn').prop("disabled", false);
	});

	$('#timeIn').on('change', function() {
		var startDate = $('#startDate').val();
		// console.log(startDate);
		var baseDate = new Date(startDate);
		var modifiedDate = new Date(startDate);
		modifiedDate.setDate(modifiedDate.getDate() + 1);
		var endDate = modifiedDate.getFullYear() + "-" + (modifiedDate.getMonth() + 1) + "-" + modifiedDate.getDate();
		// console.log(endDate);
		$('#endDate').prop("disabled", false);
		$('#endDate').datepicker({
			format: 'yyyy-mm-dd',
			minDate: baseDate,
			maxDate: modifiedDate
		});
	});

	$('#endDate').on('change',function() {
		$('#timeOut').prop("disabled", false);
	});

	$('#timeOut').on('change', function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		var timeIn = $('#timeIn').val();
		var timeOut = $('#timeOut').val();

		// GET TIME IN 24 HOUR FORMAT WITHOUT COLON AND USING 12-HOUR AS INPUT
		var meridiemIn = timeIn.substr(6, 2);
		timeIn = timeIn.substr(0, 5);
		timeIn = timeIn.replace(":", "");
		timeIn = parseInt(timeIn);

		if (meridiemIn = 'PM') {
			if (timeIn < 1200) {
				timeIn = timeIn + 1200;
				console.log(timeIn);
			}
		}

		var meridiemOut = timeOut.substr(6, 2);
		timeOut = timeOut.substr(0, 5);
		timeOut = timeOut.replace(":", "");
		timeOut = parseInt(timeOut);

		if (meridiemOut = 'PM') {
			if (timeOut < 1200) {
				timeOut = timeOut + 1200;
				console.log(timeOut);
			}
		}
		// console.log(timeOut + " " + timeIn);
		// SETS 24 HOURS AS MAXIMUM LENGTH OF WORK UNTIL NEXT DAY
		// PREVENTS NEGATIVE LENGTH OF HOURS SUBMISSION
		if (startDate == endDate) {
			if (timeOut < timeIn) {
				$('#timeOut').val("");
			}
		} else {
			if (timeOut > timeIn) {
				$('#timeOut').val("");	
			}
		}
	});

</script>