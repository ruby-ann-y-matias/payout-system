@extends('layouts.layout')

@section('content')
	<div id="jobDonutDiv">
    </div>
    <?= Lava::render('DonutChart', 'JobDonut', 'jobDonutDiv'); ?>
@endsection