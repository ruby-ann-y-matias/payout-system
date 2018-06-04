<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }

    function job() {
    	return $this->belongsTo('App\Job');
    }

    function status() {
    	return $this->belongsTo('App\Status');
    }
}
