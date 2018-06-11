<?php

namespace App\Http\Controllers;

use App\Payout;
use App\Job;
use App\Timesheet;
use App\Employee;
use DB;
use Alert;
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

    function deleteJob(Request $request) {
        $job = Job::find($request->job_id);
        $temp = $job->job;
        $job->delete();

        $jobs = Job::all();

        alert()->success("$temp deleted", 'Successfully')->autoClose(5000);

        return view('payout.jobs', compact('jobs'));
    }

    function sortByName() {

        $logs = DB::table('timesheets')
            ->leftJoin('employees', 'timesheets.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'timesheets.job_id', '=', 'jobs.id')
            ->orderBy('employees.name')->get();
        // dd($logs);
        return view('employees.sorted-logs', compact('logs'));
    }

    function sortByJob() {

        $logs = DB::table('timesheets')
            ->leftJoin('employees', 'timesheets.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'timesheets.job_id', '=', 'jobs.id')
            ->orderBy('jobs.job')->get();
        // dd($logs);
        return view('employees.sorted-logs', compact('logs'));
    }

    function sortByDate() {
        $logs = Timesheet::all();
        $logs = $logs->sortBy('date');
        
        return view('employees.logs', compact('logs'));
    }

    function sortByPriority() {
        $logs = Timesheet::all();
        $logs = $logs->sortBy('clock_out');
        
        return view('employees.logs', compact('logs'));
    }

    function checkWages() {
        $payout = Payout::all();

        return view('payout.payout', compact('payout'));
    }

    function sortName() {

        $payout = DB::table('payouts')
            ->leftJoin('employees', 'payouts.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'payouts.job_id', '=', 'jobs.id')
            ->leftJoin('statuses', 'payouts.status_id', '=', 'statuses.id')
            ->orderBy('employees.name')->get();
        // dd($logs);
        return view('payout.sorted-payout', compact('payout'));
    }

    function sortJob() {

        $payout = DB::table('payouts')
            ->leftJoin('employees', 'payouts.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'payouts.job_id', '=', 'jobs.id')
            ->leftJoin('statuses', 'payouts.status_id', '=', 'statuses.id')
            ->orderBy('jobs.job')->get();
        // dd($logs);
        return view('payout.sorted-payout', compact('payout'));
    }

    function sortDate() {
        $payout = Payout::all();
        $payout = $payout->sortBy('date');
        
        return view('payout.payout', compact('payout'));
    }

    function sortHours() {
        $payout = Payout::all();
        $payout = $payout->sortByDesc('hours');
        
        return view('payout.payout', compact('payout'));
    }

    function sortWage() {
        $payout = Payout::all();
        $payout = $payout->sortByDesc('wage');
        
        return view('payout.payout', compact('payout'));
    }

    function viewSettings() {
        return view('payout.settings');
    }

    function multiDelete(Request $request) {
        // dd($request);
        foreach ($request->deleteLogs as $deleteLog) {
            $date = substr($deleteLog, 0, 10);
            $clock_in = substr($deleteLog, 10, 8);
            $clock_out = substr($deleteLog, 18, 8);
            // echo $date . ' ' . $clock_in . ' ' . $clock_out . '<br>';
            $logs = Timesheet::where([
                            ['date', '=', $date],
                            ['clock_in', '=', $clock_in],
                            ['clock_out', '=', $clock_out]
                        ])->get();
            // dd($timesheet);
            foreach ($logs as $log) {
                $timesheet = Timesheet::find($log->id);
                $timesheet->delete();
            }
        }

        alert()->success('Logs Deleted', 'Successfully')->autoClose(5000);

        return redirect()->back();
    }
}
