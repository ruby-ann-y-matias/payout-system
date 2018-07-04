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

        alert()->success("$temp deleted", 'Successfully');

        return view('payout.jobs', compact('jobs'));
    }

    function sortByName() {

        $logs = DB::table('timesheets')
            ->leftJoin('employees', 'timesheets.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'timesheets.job_id', '=', 'jobs.id')
            ->orderBy('employees.name')->get();
        // dd($logs);
        $criteria = 'by Name';
        return view('employees.sorted-logs', compact('logs', 'criteria'));
    }

    function sortByJob() {

        $logs = DB::table('timesheets')
            ->leftJoin('employees', 'timesheets.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'timesheets.job_id', '=', 'jobs.id')
            ->orderBy('jobs.job')->get();
        // dd($logs);
        $criteria = 'by Job';
        return view('employees.sorted-logs', compact('logs', 'criteria'));
    }

    function sortByDate() {
        $logs = Timesheet::all();
        $logs = $logs->sortBy('date');
        $criteria = 'by Date';
        return view('employees.logs', compact('logs', 'criteria'));
    }

    function sortByPriority() {
        $logs = Timesheet::all();
        $logs = $logs->sortBy('clock_out');
        $criteria = 'by Priority';
        return view('employees.logs', compact('logs', 'criteria'));
    }

    function checkWages() {
        $payout = Payout::all();
        // dd($payout);
        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = '';
        return view('payout.payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortPriority() {
        $payout = Payout::all();
        $payout = $payout->sortBy('status');

        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Priority';
        return view('payout.payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortName() {

        $payout = DB::table('payouts')
            ->leftJoin('employees', 'payouts.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'payouts.job_id', '=', 'jobs.id')
            ->leftJoin('statuses', 'payouts.status_id', '=', 'statuses.id')
            ->orderBy('employees.name')->get();
        // dd($payout);
        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Name';
        return view('payout.sorted-payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortJob() {

        $payout = DB::table('payouts')
            ->leftJoin('employees', 'payouts.employee_id', '=', 'employees.id')
            ->leftJoin('jobs', 'payouts.job_id', '=', 'jobs.id')
            ->leftJoin('statuses', 'payouts.status_id', '=', 'statuses.id')
            ->orderBy('jobs.job')->get();
        // dd($payout);
        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Job';
        return view('payout.sorted-payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortDate() {
        $payout = Payout::all();
        $payout = $payout->sortBy('date');

        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Date';
        return view('payout.payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortHours() {
        $payout = Payout::all();
        $payout = $payout->sortByDesc('hours');

        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Hours';
        return view('payout.payout', compact('payout', 'paid_total', 'criteria'));
    }

    function sortWage() {
        $payout = Payout::all();
        $payout = $payout->sortByDesc('wage');

        $paid = array();
        foreach ($payout as $wage) {
            if ($wage->status_id == 2) {
                $paid[] = $wage->wage;
            }
        }
        // dd($paid);
        $paid_total = array_sum($paid);
        $criteria = 'by Wage';
        return view('payout.payout', compact('payout', 'paid_total', 'criteria'));
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

        alert()->success('Log Deleted', 'Successfully');

        return redirect()->back();
    }

    function confirmPayout(Request $request) {
        $payout = Payout::find($request->wage_id);

        return view('payout.confirm-payout', compact('payout'));
    }

    function confirmSortedPayout(Request $request) {
        $payout = Payout::where('timesheet_id', '=', $request->timesheet_id)->get();
        // dd($payout);
        return view('payout.confirm-sorted-payout', compact('payout'));
    }

    function updateStatus(Request $request) {
        $payout = Payout::find($request->payout_id);
        $payout->status_id = 2;
        $payout->save();

        return redirect()->back();
    }
}
