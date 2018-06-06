@extends('layouts.layout')

@section('breadcrumb')
    <nav>
        <div class="nav-wrapper indigo darken-2">
            <a id="rootCrumb" class="breadcrumb" href="{{ url('/home') }}">Admin</a>
            <a class="breadcrumb" href="{{ url('/home') }}">Index</a>

            <div class="right" id="clock"></div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="card grey lighten-4 dash-card">
                <div id="dashTitle" class="card-title indigo-text">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="mini-con col s12 m6 l3">
                            <a href="{{ url('/employees') }}" class="dash-link">
                                <div class="grey lighten-2 waves-effect mini-card">
                                    <i class="material-icons large indigo-text">people</i>
                                    <p class="indigo-text">Employees</p>
                                </div>
                            </a>
                        </div>

                        <div class="mini-con col s12 m6 l3">
                            <a href="{{ url('/payout') }}" class="dash-link">
                                <div class="grey lighten-2 waves-effect mini-card">
                                    <i class="material-icons large indigo-text">payment</i>
                                    <p class="indigo-text">Payout</p>
                                </div>
                            </a>
                        </div>

                        <div class="mini-con col s12 m6 l3">
                            <a href="{{ url('/timesheet') }}" class="dash-link">
                                <div class="grey lighten-2 waves-effect mini-card">
                                    <i class="material-icons large indigo-text">timer</i>
                                    <p class="indigo-text">Timesheet</p>
                                </div>
                            </a>
                        </div>

                        <div class="mini-con col s12 m6 l3">
                            <a href="{{ url('/jobs') }}" class="dash-link">
                                <div class="grey lighten-2 waves-effect mini-card">
                                    <i class="material-icons large indigo-text">build</i>
                                    <p class="indigo-text">Jobs</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('indiv_js')
    <script type="text/javascript">

    </script>
@endsection
