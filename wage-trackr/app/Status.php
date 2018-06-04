<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    function payout() {
    	return $this->hasMany('App\Payout');
    }
}
