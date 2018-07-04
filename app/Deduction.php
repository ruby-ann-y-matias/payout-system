<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }

    function job() {
    	return $this->belongsTo('App\Job');
    }

    function timesheet() {
    	return $this->belongsTo('App\Timesheet');
    }
}
