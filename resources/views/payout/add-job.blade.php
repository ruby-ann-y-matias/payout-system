@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/jobs') }}">Jobs</a>
            <a class="breadcrumb" href="{{ url('/jobs/add-new') }}">Add New</a>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<form class="add-form" action={{ url("/jobs/save-new") }} method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12">
					<input type="text" id="job" name="job" class="validate">
					<label class="active" for="job">Job Title:</label>
				</div>

				<div class="input-field col s12">
					<input type="text" id="description" name="description" class="validate">
					<label class="active" for="description">Description:</label>
				</div>

				<div class="input-field col s12">
					<input type="number" id="daily" name="daily_rate"  pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" placeholder=" ">
					<label class="active" for="daily">Daily Rate:</label>
				</div>

				<div class="input-field col s12">
					<input type="number" id="hourly" name="hourly_rate" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" min="0.01" placeholder=" ">
					<label class="active" for="hourly">Hourly Rate:</label>
				</div>

				<div class="input-field col s12">
					<input type="number" id="weekly" name="weekly_rate" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" placeholder=" ">
					<label class="active" for="weekly">Weekly Rate:</label>
				</div>

				<div class="input-field col s12">
					<input type="number" id="monthly" name="monthly_rate" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" placeholder=" ">
					<label class="active" for="monthly">Monthly Rate:</label>
				</div>

				<button type="submit" class="waves-effect btn green accent-5 right add-submit">Save</button>
				<button type="button" class="waves-effect btn deep-orange darken-3 right cancel-new-addition"><a href="{{ url('/jobs') }}">Cancel</a></button>
			</div>
		</form>
	</div>
@endsection

@section('indiv_js')
	<script type="text/javascript">
		
		$('#daily').on('input', function() {
			var daily = $('#daily').val();
			var hourly = daily / 8;
			var weekly = daily * 7;
			var monthly = weekly * 4;

			$('#hourly').val(hourly.toFixed(2));
			$('#weekly').val(weekly.toFixed(2));
			$('#monthly').val(monthly.toFixed(2));
		});

		$('#hourly').on('input', function() {
			var hourly = $('#hourly').val();
			var daily = hourly * 8;
			var weekly = daily * 7;
			var monthly = weekly * 4;

			$('#daily').val(daily.toFixed(2));
			$('#weekly').val(weekly.toFixed(2));
			$('#monthly').val(monthly.toFixed(2));
		});

		$('#weekly').on('input', function() {
			var weekly = $('#weekly').val();
			var daily = weekly / 5;
			var hourly = daily / 8;
			var monthly = weekly * 4;

			$('#daily').val(daily.toFixed(2));
			$('#hourly').val(hourly.toFixed(2));
			$('#monthly').val(monthly.toFixed(2));
		});

		$('#monthly').on('input', function() {
			var monthly = $('#monthly').val();
			var weekly = monthly / 4;
			var daily = weekly / 5;
			var hourly = daily / 8;

			$('#daily').val(daily.toFixed(2));
			$('#hourly').val(hourly.toFixed(2));
			$('#weekly').val(weekly.toFixed(2));
		});

	</script>
@endsection