<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    function payout() {
    	return $this->hasMany('App\Payout');
    }

    function timesheet() {
    	return $this->hasMany('App\Timesheet');
    }

    function history() {
    	return $this->hasMany('App\History');
    }
}
