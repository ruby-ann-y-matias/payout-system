<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function listAll() {
    	$employees = Employee::all();
    	// dd($employees);
    	return view('employees.list', compact('employees'));
    }
}
