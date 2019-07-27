<?php

namespace App\Http\Controllers;

use App\AllowedAttempt;
use App\Exceptions\ResultException;
use App\Mail\CertificationComplete;
use App\Results;
use App\User;
use Illuminate\Http\Request;

class AdminActionsController extends Controller
{
    public function listAllResultsWithoutCertification()
    {
//        $this->middleware('auth:api');
//        $appUser=User::getCurrentAPIUser();
//        if($appUser->id==1)
//        {
//            $results=Results::where('link',null)->leftJoin;
//        }
    }
    private function randString(int $length)
    {
        $validChars="0123456789abcdefghijklmnopqrstuvwxyz";
        $retString="";
        for($i=0;$i<$length;$i++)
        {
            while ($retString[0]==0)
            $retString.=$validChars[rand(0,strlen($validChars)-1)];
        }
        return $retString;
    }
    public function generateCertificate(int $attemptID)
    {
        $this->middleware('auth:api');
        $appUser=User::getCurrentAPIUser();
        $result=Results::where('attempt_id',$attemptID)->firstOrFail();
        if($result->link!="")
            throw new ResultException('Certificate Already Present');
        $certID=$this->randString(10);
        if($appUser->id==1)
        {
            AllowedAttempt::findOrFail($attemptID);
            $userName=AllowedAttempt::where('id',$attemptID)
                ->leftJoin('users','users.id','=','allowed_attempts.user_id')
                ->limit(1)
                ->select('users.name as name')->value('name');
            $userEmail=AllowedAttempt::where('id',$attemptID)
                ->leftJoin('users','users.id','=','allowed_attempts.user_id')
                ->limit(1)
                ->select('users.email as email')->value('email');
            $data = [
                'name'=>$userName,
                'validStart' => now(),
                'validEnd' => now()->addYears(2),
                'certID'=>$certID
            ];
            $pdf = PDF::loadView('certificate', $data);
            $pdf->save('/certificates/'.$certID);
            $result->link=asset('/certificates/'.$certID);
            $result->save();
            Mail::to($userEmail)->send(new CertificationComplete());
            return true;
        }
    }
}
