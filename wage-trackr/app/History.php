<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }

	function job() {
    	return $this->belongsTo('App\Job');
    }    
}
