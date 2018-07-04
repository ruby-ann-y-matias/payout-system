<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    function employee() {
    	return $this->belongsTo('App\Employee');
    }
}
