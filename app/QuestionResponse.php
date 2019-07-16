<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    //
    protected $fillable=['attempt_id','response','question_id','end_time'];
}
