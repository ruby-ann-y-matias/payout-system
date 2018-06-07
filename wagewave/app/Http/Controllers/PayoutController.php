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

    function viewJob($id) {
    	$job = Job::find($id);
    	// dd($job);

    	return view('payout.view-job', compact('job'));
    }

    function updateJob(Request $request, $id) {
        // dd($request);
        $job = Job::find($id);

        $job->job = $request->job;
        $job->description = $request->description;
        $job->daily_rate = $request->daily_rate;
        $job->hourly_rate = $request->hourly_rate;
        $job->weekly_rate = $request->weekly_rate;
        $job->monthly_rate = $request->monthly_rate;
        $job->save();

        return redirect()->back();
    }

    function addJob() {
        return view('payout.add-job');
    }

    function saveJob(Request $request) {
        // dd($request);
        $job = new Job();
        $job->job = $request->job;
        $job->description = $request->description;
        $job->daily_rate = $request->daily_rate;
        $job->hourly_rate = $request->hourly_rate;
        $job->weekly_rate = $request->weekly_rate;
        $job->monthly_rate = $request->monthly_rate;
        $job->save();

        return view('payout.view-job', compact('job'));
    }
}
