<?php

namespace App\Http\Controllers;

use App\AllowedAttempt;
use App\Certification;
use App\Course;
use App\Exceptions\ExamPrepareException;
use App\Question;
use App\QuestionResponse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    public function index(int $activationID)
    {
        $this->middleware('auth');
        $appUser = Auth::guard('web')->user()->id;
        $attempt=AllowedAttempt::findOrFail($activationID);
        if($attempt->is_active!=1)
            throw new ExamPrepareException('ERR XR5, Instance Recorded');

        $certID = AllowedAttempt::where([['allowed_attempts.id', '=', $activationID], ['allowed_attempts.user_id', '=', $appUser]])
            ->value('certification_id');

        $topics = Course::where('courses.certification_id', $certID)
            ->leftJoin('topics', 'topics.course_id', '=', 'courses.id')
            ->select('topics.list', 'courses.code', 'courses.name', 'topics.id','courses.alloc_size as no_of_questions')
            ->get()
            ->toArray();
        $topicsWithQuestions = [];
        $allocatedQuestionIDs=[];
        foreach ($topics as $topic) {
            $questions = Question::where('topic_id', '=', $topic['id'])
                ->inRandomOrder()
                ->limit($topic['no_of_questions'])
                ->select('question_text', 'option_1', 'option_2', 'option_3', 'option_4', 'option_others', 'images','id','type')
                ->get()->toArray();
            $finalQuestions = [];
            foreach ($questions as $question) {
                $ques = [
                    "question_marker"=>$question['id'],
                    "type"=>$question['type'],
                    "question_text" => $question['question_text'],
                    "images"=>null,
                    "options" => ["option_1" => $question['option_1'], "option_2" => $question['option_2'], "option_3" => $question['option_3'], "option_4" => $question['option_4']]
                ];
                array_push($allocatedQuestionIDs,$question['id']);
                if ($question['option_others'] != '' || $question['option_others'] != null) {
                    $moreOptions = [];
                    $options = explode(',::,', $question['option_others']);
                    $i = 5;
                    foreach ($options as $option) {
                        $moreOptions += ['option_'.$i => $option];
                        $i++;
                    }
                    $ques['options']+=$moreOptions;
                }
                if ($question['images'] != '' || $question['images'] != null) {
                    $images = explode(',', $question['images']);
                    $ques['images']=$images;
                }
                array_push($finalQuestions,$ques);
            }
            array_push($topicsWithQuestions, [
                'topicName' => $topic['name'],
                'code'=>$topic['code'],
                'questions' => $finalQuestions
            ]);
        }
        $certs = AllowedAttempt::where([['allowed_attempts.id', '=', $activationID], ['allowed_attempts.user_id', '=', $appUser]])
            ->leftJoin('certifications', 'allowed_attempts.certification_id', '=', 'certifications.id')
            ->select(
                'allowed_attempts.id as activationID',
                'certifications.name as certificationName',
                'certifications.code as certificationCode',
                'certifications.allowed_time as totalTime',
                'allowed_attempts.created_at as activationDate'
            )->get()->toArray()[0];
        $certification=Certification::findOrFail($certID);
        $minutes=$certification->allowed_time;
        if(count($allocatedQuestionIDs)!=$certification->total_questions)
        {
            throw new ExamPrepareException('Error : EX45 Prepare Exception Occurred');
            return;
        }else
        {
           foreach ($allocatedQuestionIDs as $qID)
           {
               QuestionResponse::create(
                   [
                       'end_time'=>now()->addMinutes($minutes),
                       'attempt_id'=>$activationID,
                       'question_id'=>$qID
                   ]
               );
           }
        }
        $data = [
            'totalQuestions'=>count($allocatedQuestionIDs),
            'endTime'=>$minutes,
            'attemptID'=>$activationID,
            'topicsQuestions'=>$topicsWithQuestions,
            'certification' => $certs
        ];
        $attempt->is_active=0;
        $attempt->save();
        return view('attempt', $data);
    }

    public function allUnAttempted()
    {
        $this->middleware('auth:api');
        $appUser = User::getCurrentAPIUser();
        return AllowedAttempt::where([['user_id','=', $appUser['id']],['is_active','=',1]])
            ->leftJoin('certifications', 'allowed_attempts.certification_id', '=', 'certifications.id')
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
    public function allPassed()
    {
        $this->middleware('auth:api');
        $appUser = User::getCurrentAPIUser();
        return AllowedAttempt::where([['user_id','=', $appUser['id']],['is_active','=',0]])
            ->leftJoin('certifications', 'allowed_attempts.certification_id', '=', 'certifications.id')
            ->leftJoin('results', 'results.attempt_id','=','allowed_attempts.id')
            ->select(
                'allowed_attempts.id as activationID',
                'certifications.name as certificationName',
                'allowed_attempts.updated_at as attendedDate',
                'results.score as grade',
                'results.link as link',
                'results.end_date as validity'
            )->get();
    }

    public function topicLists(int $activationID)
    {
        $this->middleware('auth:api');
        $appUser = User::getCurrentAPIUser();
        $certID = AllowedAttempt::where([['allowed_attempts.id', '=', $activationID], ['allowed_attempts.user_id', '=', $appUser['id']]])->value('certification_id');
        return Course::where('courses.certification_id', $certID)
            ->leftJoin('topics', 'topics.course_id', '=', 'courses.id')
            ->select('topics.list', 'courses.code', 'courses.name')
            ->get();
    }
    public function storeResponses(Request $request)
    {
        $this->middleware('auth:api');
        $validatedData=$request->validate([
            '*.attemptID'=>'required|exists:allowed_attempts,id',
            '*.answer'=>'nullable',
            '*.markerID'=>'required|numeric|exists:questions,id'
        ]);
        if(AllowedAttempt::findOrFail($validatedData[0]["attemptID"])->user_id!=Auth::guard('api')->user()->id)
        {
            throw new ExamPrepareException('Unknown Error');
        }
        foreach ($validatedData as $data)
        {
            QuestionResponse::where([['end_time','>=',now()],['attempt_id','=',$data['attemptID']],['question_id','=',$data['markerID']]])->update(array('response'=>$data['answer']));
        }
        return $validatedData;
    }
}
