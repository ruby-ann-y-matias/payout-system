@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Index</a>
            <a class="breadcrumb" href="{{ url('/employees') }}">Employees</a>
            <a class="breadcrumb" href="{{ url('/employees/add-new') }}">Add New</a>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<form class="add-form" action={{ url("employees/save-new") }} method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12">
					<input type="text" id="name" name="name" class="validate" required>
					<label class="active" for="name">Name:</label>
				</div>
				<div class="input-field col s12">
					<select name="gender" required class="validate">
						<option value="" disabled selected>Choose your option</option>
						<option value="male">male</option>
						<option value="female">female</option>
					</select>
					<label for="gender">Gender:</label>
				</div>
				<div class="input-field col s12">
					<input type="tel" id="mobile" name="mobile" class="validate">
					<label class="active" for="mobile">Contact no.:</label>
				</div>
				<div class="input-field col s12">
					<input type="text" id="address" name="address" class="validate">
					<label class="active" for="address">Address:</label>
				</div>
				<div class="input-field col s12">
					<input type="date" id="birthDate" name="birth_date" class="validate" max="2000-06-12" min="1958-06-12">
					<label class="active" for="birthDate">Birth Date:</label>
				</div>
				<div class="input-field col s12">
					<input type="email" id="email" name="email" class="validate">
					<label class="active" for="email">Email:</label>
				</div>
				<div class="input-field col s12">
					<input type="text" id="TIN" name="TIN" class="validate" oninput="formatTIN()" pattern="[0-9-]{12,}" maxlength="15">
					<label class="active" for="TIN">TIN:</label>
				</div>
				<div class="input-field col s12">
					<input type="text" id="SSS" name="SSS" class="validate" oninput="formatSSS()" pattern="[0-9-]{10,}" maxlength="12">
					<label class="active" for="SSS">SSS:</label>
				</div>
				<div class="input-field col s12">
					<input type="text" id="Pagibig" name="Pagibig" class="validate" oninput="formatPagibig()" pattern="[0-9-]{12,}" maxlength="14">
					<label class="active" for="Pagibig">Pag-ibig MID:</label>
				</div>
				<button type="submit" class="waves-effect btn green accent-5 right add-submit">Save</button>
				<button type="button" class="waves-effect btn deep-orange darken-3 right cancel-new-addition"><a href="{{ url('/employees') }}">Cancel</a></button>
			</div>
		</form>

	</div>
@endsection

@section('indiv_js')
	<script type="text/javascript">

		$(document).ready(function() {
			$('select').formSelect();
		});
		
		function formatTIN() {
			var inputTIN = document.getElementById("TIN");
			var newTIN = document.getElementById("TIN").value;
			// console.log(newTIN);
			newTIN = newTIN.replace(/[\W\D\s\._\-]+/g, '');

			var split = 3;
			var chunk = [];

			for (var i = 0, len = newTIN.length; i < len; i += split) {
				chunk.push(newTIN.substr(i, split));
			}

			var formattedTIN = chunk.join("-");
			// console.log(formattedTIN);
			inputTIN.value = formattedTIN;
		}

		function formatSSS() {
			var inputSSS = document.getElementById("SSS");
			var newSSS = document.getElementById("SSS").value;
			// console.log(newSSS);
			newSSS = newSSS.replace(/[\W\D\s\._\-]+/g, '');

			var split;
			var chunk = [];

			for (var i = 0, len = newSSS.length; i < len; i++) {
				switch (i) {
					case 0:
						split = 2;
						break;
					case 2:
						split = 7;
						break;
					case 9:
						split = 1;
						break;
					default:
						continue;
				}
				chunk.push(newSSS.substr(i, split));
			}

			var formattedSSS = chunk.join("-");
			// console.log(formattedSSS);
			inputSSS.value = formattedSSS;
		}

		function formatPagibig() {
			var inputPagibig = document.getElementById("Pagibig");
			var newPagibig = document.getElementById("Pagibig").value;
			// console.log(newPagibig);
			newPagibig = newPagibig.replace(/[\W\D\s\._\-]+/g, '');

			var split = 4;
			var chunk = [];

			for (var i = 0, len = newPagibig.length; i < len; i += split) {
				chunk.push(newPagibig.substr(i, split));
			}

			var formattedPagibig = chunk.join("-");
			// console.log(formattedPagibig);
			inputPagibig.value = formattedPagibig;
		}

	</script>
@endsection