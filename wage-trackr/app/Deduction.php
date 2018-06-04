<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }
}
