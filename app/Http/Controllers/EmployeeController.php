<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Timesheet;
use App\Payout;
use App\Job;
use DateTime;
use DateInterval;
use Alert;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listAll() {
    	$employees = Employee::all();
    	// $employees = Employee::paginate(10);
    	// dd($employees);
    	return view('employees.list', compact('employees'));
    }

    public function viewIndividual($id) {
    	$employee = Employee::find($id);
        $jobs = Job::all();
    	// dd($employee);
        date_default_timezone_set('Asia/Manila');
        $today = date('F j, Y');

        $date = date('Y-n-j');

        $logs = Timesheet::where([
                        ['employee_id', '=', $id],
                        ['date', '=', $date]
                    ])->get();
        // dd($logs);
        $payouts = Payout::where([
                        ['employee_id', '=', $id],
                        ['date', '=', $date]
                    ])->get();

        $history = Timesheet::where('employee_id', '=', $id)->get();
        $wages = Payout::where('employee_id', '=', $id)->get();

    	return view('employees.view', compact('employee', 'today', 'logs', 'jobs', 'payouts', 'history', 'wages'));
    }

    public function updateInfo(Request $request, $id) {
    	// dd($request);
    	// echo $id;
    	$employee = Employee::find($id);

    	$employee->name = $request->name;
    	$employee->mobile = $request->mobile;
    	$employee->address = $request->address;
    	$employee->birth_date = $request->birth_date;
    	$employee->TIN = $request->TIN;
    	$employee->SSS = $request->SSS;
    	$employee->Pagibig = $request->Pagibig;
    	$employee->save();

    	return redirect()->back();
    }

    public function addNew() {
        return view('employees.add-new');
    }

    public function saveNew(Request $request) {
        date_default_timezone_set('Asia/Manila');
        $today = date('F j, Y');
        $date = date('Y-n-j');
        $jobs = Job::all();
        // dd($request);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->birth_date = $request->birth_date;
        $employee->email = $request->email;
        $employee->TIN = $request->TIN;
        $employee->SSS = $request->SSS;
        $employee->Pagibig = $request->Pagibig;

        if ($request->gender == 'male') {
            $employee->image = 'img/male.jpg';
        } else {
            $employee->image = 'img/female.jpg';
        }

        $employee->save();

        $logs = Timesheet::where([
                        ['employee_id', '=', $employee->id],
                        ['date', '=', $date]
                    ])->get();
        // dd($logs);
        $payouts = Payout::where([
                        ['employee_id', '=', $employee->id],
                        ['date', '=', $date]
                    ])->get();

        $history = Timesheet::where('employee_id', '=', $employee->id)->get();
        $wages = Payout::where('employee_id', '=', $employee->id)->get();

        alert()->success('New employee saved', 'Successfully');

        return view('employees.view', compact('employee', 'today', 'logs', 'payouts', 'jobs', 'history', 'wages'));
    }

    public function checkLogs() {
        $logs = Timesheet::all();
        // dd($logs);
        $criteria = '';
        return view('employees.logs', compact('logs', 'criteria'));
    }

    public function clockIn(Request $request) {
        $employee = Employee::find($request->employee_id);
        $job = Job::find($request->job_id);
        // dd($employee);
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-n-j');
        $time = date('H:i:s');

        $timesheet = new Timesheet();
        $timesheet->employee_id = $request->employee_id;
        $timesheet->job_id = $request->job_id;
        $timesheet->date = $today;
        $timesheet->clock_in = $time;
        $timesheet->save();

        return view('employees.in', compact('timesheet', 'job'));
    }

    public function clockOut(Request $request) {
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-n-j');
        $time = date('H:i:s');

        $logs = Timesheet::where([
                        ['date', '=', $today],
                        ['employee_id', '=', $request->employee_id]
                    ])->get();
        // dd($logs);
        foreach ($logs as $timesheet) {
            $timesheet->clock_out = $time;
            $timesheet->save();
        }

        $job = Job::find($timesheet->job_id);

        $start = strtotime(str_replace('/', '-', $timesheet->date . ' ' . $timesheet->clock_in));
        $end = strtotime(str_replace('/', '-', $timesheet->date . ' ' . $timesheet->clock_out));
        $hours = abs($start - $end) / 3600;
        $minutes = $hours * 60;

        $payout = new Payout();
        $payout->employee_id = $request->employee_id;
        $payout->job_id = $timesheet->job_id;
        $payout->timesheet_id = $timesheet->id;
        $payout->date = $timesheet->date;
        $payout->hours = $hours;
        $payout->wage = $hours * $job->hourly_rate;
        $payout->status_id = 1;
        $payout->save();

        return view('employees.out', compact('timesheet', 'payout', 'minutes'));
    }

    public function completeLog($id) {
        $timesheet = Timesheet::find($id);
        // dd($timesheet);
        $start_date = new DateTime($timesheet->date);
        $start_date->modify('+1 day');
        $max_date = $start_date->format('Y-m-j');
        // echo $max_date;
        $one_hour_lapse = strtotime($timesheet->clock_in) + 60*60;
        $min_time = date('H:i:s', $one_hour_lapse);
        // echo $min_time;
        return view('employees.complete-log', compact('timesheet', 'max_date', 'min_time'));
    }

    public function completeLogWithoutId(Request $request) {
        // dd($request);
        $date = substr($request->timesheet, 0, 10);
        $clock_in = substr($request->timesheet, 10, 8);
        // echo $date . ' ' . $clock_in;
        $logs = Timesheet::where([
                            ['date', '=', $date],
                            ['clock_in', '=', $clock_in],
                        ])->get();
        // dd($logs);
        foreach ($logs as $log) {
            $timesheet = Timesheet::find($log->id);
            // dd($timesheet);
            $start_date = new DateTime($timesheet->date);
            $start_date->modify('+1 day');
            $max_date = $start_date->format('Y-m-j');
            // echo $max_date;
            $one_hour_lapse = strtotime($timesheet->clock_in) + 60*60;
            $min_time = date('H:i:s', $one_hour_lapse);
            // echo $min_time;
            return view('employees.complete-log', compact('timesheet', 'max_date', 'min_time'));
        }
    }

    public function lateLogOut(Request $request) {
        // dd($request);
        $timesheet = Timesheet::find($request->timesheet_id);
        $job = Job::find($timesheet->job->id);
        // dd($timesheet);
        // dd($job);
        $timesheet->clock_out = $request->clock_out;
        $timesheet->save();

        $start_date = new DateTime($timesheet->date);
        $start_date->modify('+1 day');
        $max_date = $start_date->format('Y-m-j');

        if ($request->date_out == $timesheet->date) {
            $start = strtotime(str_replace('/', '-', $timesheet->date . ' ' . $timesheet->clock_in));
            $end = strtotime(str_replace('/', '-', $timesheet->date . ' ' . $timesheet->clock_out));
            $hours = abs($start - $end) / 3600;
        } else {
            $start = strtotime(str_replace('/', '-', $timesheet->date . ' ' . $timesheet->clock_in));
            $end = strtotime(str_replace('/', '-', $max_date . ' ' . $timesheet->clock_out));
            $hours = abs($start - $end) / 3600;
        }

        $payout = new Payout();
        $payout->employee_id = $timesheet->employee_id;
        $payout->job_id = $timesheet->job_id;
        $payout->timesheet_id = $timesheet->id;
        $payout->date = $timesheet->date;
        $payout->hours = $hours;
        $payout->wage = $hours * $job->hourly_rate;
        $payout->status_id = 1;
        $payout->save();

        alert()->success('Log completed', 'Successfully');

        return redirect()->back();
    }

    public function deleteEmployee(Request $request) {
        // dd($request);
        $employee = Employee::find($request->employee_id);
        $temp = $employee->name;
        $employee->delete();

        $employees = Employee::all();

        alert()->success("$temp's account deleted", 'Successfully');

        return view('employees.list', compact('employees'));
    }

    public function deleteLog(Request $request) {
        $timesheet = Timesheet::find($request->timesheet_id);
        // dd($timesheet);
        $timesheet->delete();

        alert()->success('Log Deleted', 'Successfully');

        return redirect()->back();
    }

    public function newLog() {
        $employees = Employee::all();
        $jobs = Job::all();

        return view('employees.new-log', compact('employees', 'jobs'));
    }

    public function saveLog(Request $request) {
        $incomplete = Timesheet::where([
                        ['employee_id', '=', $request->employee_id],
                        ['date', '=', $request->start_date],
                        ['clock_out', '=', null],
                    ])->get();
        // dd($incomplete);
        if ($incomplete->isEmpty()) {
            $job = Job::find($request->job_id);

            $start = $request->start_date . ' ' . $request->clock_in;
            $start = strtotime($start);
            $end = $request->end_date . ' ' . $request->clock_out;
            $end = strtotime($end);
            $hours = abs($start - $end) / 3600;
            // echo $hours;
            $clock_in = date('H:i:s', $start);
            $clock_out = date('H:i:s', $end);

            $timesheet = new Timesheet();
            $timesheet->employee_id = $request->employee_id;
            $timesheet->job_id = $request->job_id;
            $timesheet->job_id = $request->job_id;
            $timesheet->date = $request->start_date;
            $timesheet->clock_in = $clock_in;
            $timesheet->clock_out = $clock_out;
            $timesheet->save();

            $payout = new Payout();
            $payout->employee_id = $timesheet->employee_id;
            $payout->job_id = $timesheet->job_id;
            $payout->timesheet_id = $timesheet->id;
            $payout->date = $timesheet->date;
            $payout->hours = $hours;
            $payout->wage = $hours * $job->hourly_rate;
            $payout->status_id = 1;
            $payout->save();

            alert()->success('Log Saved', 'Successfully');
        } else {
            alert()->error('Oops!', "Employee has not yet clocked out of a previously started job.");
        }

        return redirect()->back();
    }
}
