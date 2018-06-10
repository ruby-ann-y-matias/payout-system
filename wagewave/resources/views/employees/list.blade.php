@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/employees') }}">Employees</a>
        </div>
    </nav>
@endsection

@section('content')

	<div class="container">

		@if (!$employees->isEmpty())
		<input type="text" id="searchInput" onkeyup="pseudoFuzzy()" placeholder="Search for employee's name" class="form-control">

		<ul id="employeeList">
			@foreach($employees as $employee)
			<li><a href={{ url("/employee/$employee->id") }} class="black-text">{{ $employee->name }}</a></li>
			@endforeach
			<li><a href="#"> <a></li>
		</ul>

		{{-- {{ $employees->links() }} --}}

		<div class="fixed-action-btn">
			<a class="btn-floating btn-large teal modal-trigger" href="{{ url('employees/add-new') }}">
				<i class="material-icons">add</i>
			</a>
		</div>

		@else

		<div class="empty-container">
			<h5 class="empty-msg center-align indigo-text">No employees found.</h5>
			<a class="btn-large teal modal-trigger" href="{{ url('/jobs/add-new') }}">Add Someone Now</a>
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
			ul = document.getElementById("employeeList");
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