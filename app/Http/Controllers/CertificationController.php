<?php

namespace App\Http\Controllers;

use App\AllowedAttempt;
use App\Course;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(int $activationID)
    {
        $appUser=Auth::guard('web')->user()->id;

        $certID=AllowedAttempt::where([['allowed_attempts.id','=',$activationID],['allowed_attempts.user_id','=',$appUser]])
            ->value('certification_id');

        $topics=Course::where('courses.certification_id',$certID)
            ->leftJoin('topics','topics.course_id','=','courses.id')
            ->select('topics.list','courses.code','courses.name')
            ->get()->toArray();

        $certs=AllowedAttempt::where([['allowed_attempts.id','=',$activationID],['allowed_attempts.user_id','=',$appUser]])
            ->leftJoin('certifications','allowed_attempts.certification_id','=','certifications.id')
            ->select(
                'allowed_attempts.id as activationID',
                'certifications.name as certificationName',
                'certifications.code as certificationCode',
                'certifications.allowed_time as totalTime',
                'allowed_attempts.created_at as activationDate'
            )->get()->toArray()[0];
        $data=[
            'topics'=>$topics,
            'certification'=>$certs
        ];
        return view('attempt',$data);
    }
    public function allUnAttempted()
    {
        $appUser= User::getCurrentAPIUser();
        return AllowedAttempt::where('user_id',$appUser['id'])
            ->leftJoin('certifications','allowed_attempts.certification_id','=','certifications.id')
//            ->leftJoin('courses','courses.certification_id','=','certifications.id')
//            ->leftJoin('topics','topics.course_id','=','courses.id')
            ->select(
                'allowed_attempts.id as activationID',
                'certifications.name as certificationName',
                'certifications.code as certificationCode',
                'certifications.allowed_time as totalTime',
                'allowed_attempts.created_at as activationDate'
            )->get();
    }
    public function topicLists(int $activationID)
    {
        $appUser=User::getCurrentAPIUser();
        $certID=AllowedAttempt::where([['allowed_attempts.id','=',$activationID],['allowed_attempts.user_id','=',$appUser['id']]])->value('certification_id');
        return Course::where('courses.certification_id',$certID)
            ->leftJoin('topics','topics.course_id','=','courses.id')
            ->select('topics.list','courses.code','courses.name')
            ->get();

    }
}
