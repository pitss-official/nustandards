<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    //
    protected $visible=['start','end_date','score','attempt_id'];
    public function allowed_attempt()
    {
        return $this->hasOne('App\AllowedAttempt','id','attempt_id');
    }
}
