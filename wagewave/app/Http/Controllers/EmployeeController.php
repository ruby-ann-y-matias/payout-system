<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Timesheet;
use App\Payout;
use App\Job;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function listAll() {
    	$employees = Employee::all();
    	// $employees = Employee::paginate(10);
    	// dd($employees);
    	return view('employees.list', compact('employees'));
    }

    function viewIndividual($id) {
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
    	return view('employees.view', compact('employee', 'today', 'logs', 'jobs'));
    }

    function updateInfo(Request $request, $id) {
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

    function addNew() {
        return view('employees.add-new');
    }

    function saveNew(Request $request) {
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

        return view('employees.view', compact('employee'));
    }

    function checkLogs() {
        $logs = Timesheet::all();

        return view('employees.logs', compact('logs'));
    }

    function clockIn(Request $request) {
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

        return view('employees.timesheet', compact('timesheet', 'job'));
    }

    function clockOut(Request $request) {
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

        return view('employees.timesheet', compact('timesheet'));
    }
}
