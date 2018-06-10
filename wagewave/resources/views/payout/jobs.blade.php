@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/jobs') }}">Jobs</a>
        </div>
    </nav>
@endsection

@section('content')

	<div class="container">
		@if (!$jobs->isEmpty())
		<input type="text" id="searchInput" onkeyup="pseudoFuzzy()" placeholder="Search for job title" class="form-control">

		<ul id="jobList">
			@foreach($jobs as $job)
			<li><a href={{ url("job/$job->id") }} class="black-text">{{ $job->job }}</a></li>
			@endforeach
			<li><a href="#"> <a></li>
		</ul>

		{{-- {{ $jobs->links() }} --}}

		<div class="fixed-action-btn">
			<a class="btn-floating btn-large teal modal-trigger" href="{{ url('/jobs/add-new') }}">
				<i class="material-icons">add</i>
			</a>
		</div>

		@else

		<div class="empty-container">
			<h5 class="empty-msg center-align indigo-text">Job list feels quite lonely.</h5>
			<a class="btn-large teal modal-trigger" href="{{ url('/jobs/add-new') }}">Add New Job Now</a>
		</div>

		@endif
	</div>

@endsection

@section('indiv_js')
	<script type="text/javascript">
		
		function pseudoFuzzy() {
			var input, filter, ul, li, a, i;
			input = document.getElementById("searchInput");
			filter = input.value.toUpperCase();
			// alert(filter);
			ul = document.getElementById("jobList");
			li = ul.getElementsByTagName("li");

			// console.log(JSON.parse(JSON.stringify(li)));
			// console.log(li.length);

			for (i = 0; i < li.length; i++) {
				a = li[i].getElementsByTagName("a")[0];
				// console.log(a.innerHTML);
				if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
					li[i].style.display = "";
				} else {
					li[i].style.display = "none";
				}
			}
		}

	</script>
@endsection