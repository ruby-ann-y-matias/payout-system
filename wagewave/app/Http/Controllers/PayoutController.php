<?php

namespace App\Http\Controllers;

use App\Payout;
use App\Job;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    function listJobs() {
    	$jobs = Job::all();
    	// dd($jobs);

    	return view('payout.jobs', compact('jobs'));
    }
}
