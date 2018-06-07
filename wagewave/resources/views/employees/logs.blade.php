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

			<h1>Hello</h1>

		@else

		<div class="empty-container">
			<h5 class="empty-msg center-align indigo-text">No records found.</h5>
			<a class="btn-large teal modal-trigger" href="{{ url('/jobs/add-new') }}">Log Now</a>
		</div>

		@endif

	</div>

@endsection

@section('indiv_js')

@endsection