@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/jobs') }}">Jobs</a>
            <a class="breadcrumb" href={{ url("/job/$job->id") }}>{{ $job->id }}</a>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col s12 m4">
				<div class="card">
					<div class="card-image halfway-fab-header">
						<button id="editBtn" class="btn-floating halfway-fab waves-effect waves-light red darken-4"><i class="material-icons">edit</i></button>
					</div>
					<div id="currentInfo" class="card-content">
						<h5>{{ $job->job }}</h5>
						<p><strong>Description:</strong> {{ $job->description }}</p>
						<hr>
						<p><strong>Daily Rate: $</strong> {{ number_format($job->daily_rate, 2, '.', ',') }}</p>
						<hr>
						<p><strong>Hourly Rate: $</strong> {{ number_format($job->hourly_rate, 2, '.', ',') }}</p>
						<hr>
						<p><strong>Weekly Rate: $</strong> {{ number_format($job->weekly_rate, 2, '.', ',') }}</p>
						<hr>
						<p><strong>Monthly Rate: $</strong> {{ number_format($job->monthly_rate, 2, '.', ',')  }}</p>
						<button type="button" class="btn waves-effect red darken-4 modal-trigger delete-btn" href="#deleteJobModal"><i class="material-icons">delete_forever</i> Delete Job</button>
						<div class="modal" id="deleteJobModal">
							<div id="deleteModalContent" class="modal-content">
								<form action="/job/delete/{{ $job->id }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('delete') }}
									<p>Are your sure you want to delete<br>{{ $job->job }} from jobs?</p>
									<input hidden name="job_id" value="{{ $job->id }}">
									<button type="submit" class="btn waves-effect red darken-4">Yes</button>
									<button type="button" class="btn waves-effect teal lighten-3 modal-close">No</button>
								</form>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
							</div>
						</div>
					</div>
					<div id="editInfo" class="card-content" hidden>
						<form id="editForm" action={{ url("/job/$job->id/update") }} method="POST">
							{{ csrf_field() }}
							<div class="row">
								<div class="input-field col s12">
									<input type="text" id="job" name="job" value="{{ $job->job }}" class="validate">
									<label class="active" for="job">Job Title:</label>
								</div>

								<div class="input-field col s12">
									<input type="text" id="description" name="description" value="{{ $job->description }}" class="validate">
									<label class="active" for="description">Description:</label>
								</div>

								<div class="input-field col s12">
									<input type="number" id="daily" name="daily_rate" value="{{ $job->daily_rate }}" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate">
									<label class="active" for="daily">Daily Rate:</label>
								</div>

								<div class="input-field col s12">
									<input type="number" id="hourly" name="hourly_rate" value="{{ $job->hourly_rate }}" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" min="0.01">
									<label class="active" for="hourly">Hourly Rate:</label>
								</div>

								<div class="input-field col s12">
									<input type="number" id="weekly" name="weekly_rate" value="{{ $job->weekly_rate }}" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" placeholder="This field auto-computes">
									<label class="active" for="weekly">Weekly Rate:</label>
								</div>

								<div class="input-field col s12">
									<input type="number" id="monthly" name="monthly_rate" value="{{ $job->monthly_rate }}" pattern="[0-9.][^a-zA-Z_]" step="0.01" class="validate" placeholder="This field auto-computes">
									<label class="active" for="monthly">Monthly Rate:</label>
								</div>
								
								<button type="submit" class="waves-effect btn green accent-5 right">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('indiv_js')
	<script type="text/javascript">
		
		$(document).ready(function() {
			$('.modal').modal();

			$('#editBtn').click(function() {
				$('#currentInfo').toggle();
				$('#editInfo').toggle();
			});
		});

		$('#daily').on('input', function() {
			var daily = $('#daily').val();
			var hourly = daily / 8;
			var weekly = daily * 5;
			var monthly = weekly * 4;

			$('#hourly').val(hourly.toFixed(2));
			$('#weekly').val(weekly.toFixed(2));
			$('#monthly').val(monthly.toFixed(2));
		});

		$('#hourly').on('input', function() {
			var hourly = $('#hourly').val();
			var daily = hourly * 8;
			var weekly = daily * 5;
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