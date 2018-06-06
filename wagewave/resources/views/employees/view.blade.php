@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/employees') }}">Employees</a>
            <a class="breadcrumb" href={{ url("/employee/$employee->id") }}>{{ $employee->id }}</a>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col s12 m4">
				<div class="card">
					<div class="card-image">
						<img src={{ asset("$employee->image") }} class="responsive-img">
						<span class="card-title">{{ $employee->id }}</span>
						<button id="editBtn" class="btn-floating halfway-fab waves-effect waves-light red accent-4"><i class="material-icons">edit</i></button>
					</div>
					<div id="currentInfo" class="card-content">
						<h5>{{ $employee->name }}</h5>
						<p><b>Contact no.:</b> {{ $employee->mobile }}</p>
						<hr>
						<p><b>Address:</b> {{ $employee->address }}</p>
						<hr>
						<p><b>Birth date:</b> {{ $employee->birth_date }}</p>
						<hr>
						<p><b>TIN:</b> {{ $employee->TIN }}</p>
						<hr>
						<p><b>SSS:</b> {{ $employee->SSS }}</p>
						<hr>
						<p><b>Pag-ibig MID:</b> {{ $employee->Pagibig }}</p>
					</div>
					<div id="editInfo" class="card-content" hidden>
						<form id="editForm" action={{ url("/employee/$employee->id/update") }} method="POST">
							{{ csrf_field() }}
							<div class="row">
								<div class="input-field col s12">
									<input type="text" id="name" name="name" value="{{ $employee->name }}" class="validate">
									<label class="active" for="name">Name:</label>
								</div>
								<div class="input-field col s12">
									<input type="tel" id="mobile" name="mobile" value="{{ $employee->mobile }}" class="validate">
									<label class="active" for="mobile">Contact no.:</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="address" name="address" value="{{ $employee->address }}" class="validate">
									<label class="active" for="address">Address:</label>
								</div>
								<div class="input-field col s12">
									<input type="date" id="birthDate" name="birth_date" value="{{ $employee->birth_date }}" class="validate">
									<label class="active" for="birthDate">Birth Date:</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="TIN" name="TIN" value="{{ $employee->TIN }}" class="validate" oninput="formatTIN()" pattern="[^A-Za-z][0-9]{12,}" maxlength="15">
									<label class="active" for="TIN">TIN:</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="SSS" name="SSS" value="{{ $employee->SSS }}" class="validate" oninput="formatSSS()" pattern="[0-9]{10,}" maxlength="12">
									<label class="active" for="SSS">SSS:</label>
								</div>
								<div class="input-field col s12">
									<input type="text" id="Pagibig" name="Pagibig" value="{{ $employee->Pagibig }}" class="validate">
									<label class="active" for="Pagibig">Pag-ibig MID:</label>
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
			$('#editBtn').click(function() {
				$('#currentInfo').toggle();
				$('#editInfo').toggle();
			});
		});

		function formatTIN() {
			var input = document.getElementById("TIN");
			var newTIN = document.getElementById("TIN").value;
			// console.log(newTIN);
			newTIN = newTIN.replace(/[\W\s\._\-]+/g, '');

			var split = 3;
			var chunk = [];

			for (var i = 0, len = newTIN.length; i < len; i += split) {
				chunk.push(newTIN.substr(i, split));
			}

			var formattedTIN = chunk.join("-");
			// console.log(formattedTIN);
			input.value = formattedTIN;
		}

		function formatSSS() {
			var input = document.getElementById("SSS");
			var newSSS = document.getElementById("SSS").value;
			// console.log(newSSS);
			newSSS = newSSS.replace(/[\W\s\._\-]+/g, '');

			var split = 3;
			var chunk = [];

			for (var i = 0, len = newSSS.length; i < len; i += split) {
				chunk.push(newSSS.substr(i, split));
			}

			var formattedSSS = chunk.join("-");
			// console.log(formattedSSS);
			input.value = formattedSSS;
		}



	</script>
@endsection