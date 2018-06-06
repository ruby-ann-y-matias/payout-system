<?php

namespace App\Http\Controllers;

use App\Employee;
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
    	// dd($employee);
    	return view('employees.view', compact('employee'));
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
}
