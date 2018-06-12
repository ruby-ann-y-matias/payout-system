<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }

    function job() {
    	return $this->belongsTo('App\Job');
    }

    function payout() {
    	return $this->belongsTo('App\Payout');
    }

    function deduction() {
    	return $this->hasOne('App\Deduction');
    }
}
