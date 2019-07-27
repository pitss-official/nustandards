<?php

namespace App\Http\Controllers;

use App\AllowedAttempt;
use App\Exceptions\ResultException;
use App\Mail\CertificationComplete;
use App\Results;
use App\User;
use PDF;
use Mail;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            $retString.=$validChars[rand(0,strlen($validChars)-1)];
        }
        return $retString;
    }
    public function generateCertificate(Request $request)
    {
        $validatedData=$request->validate([
           'attemptID'=>'required|numeric|min:0|exists:results,attempt_id'
        ]);
        $attemptID=(int)strip_tags($validatedData['attemptID']);
        $this->middleware('auth:api');
        $appUser=User::getCurrentAPIUser();
        $result=Results::where('attempt_id',$attemptID)->firstOrFail();
        if($result->link!="")
            throw new ResultException('Certificate Already Present');
        $certID=$this->randString(12);
        while ($certID[0]==0||Results::where('certID',$certID)->count()!=0)
            $certID=$this->randString(12);
        if($appUser["id"]==1)
        {
            $attempt=AllowedAttempt::findOrFail($attemptID);
            $userName=$attempt->user->name;
            $userEmail=$attempt->user->email;
            $data = [
                'grade'=>$result->score,
                'name'=>ucwords(strtolower($userName)),
                'validStart' => now()->toFormattedDateString(),
                'validEnd' => now()->addYears(1)->toFormattedDateString(),
                'certID'=>$certID
            ];
            $pdf = PDF::loadView('certificate', $data)->setPaper('a4', 'landscape');;
            $pdf->save('certificates/'.$certID.'.pdf');
            $result->certID=$certID;
            $result->end_date=now()->addYears(1);
            $result->start=now();
            $result->link=asset('/certificates/'.$certID.'.pdf');
            $result->save();
            $mailable=[
                'name'=>ucwords(strtolower($userName)),
                'grade'=>$result->score,
                'certificationName'=>'Associate Automation Engineer Certification',
                'expiry'=>now()->addYears(1)->toFormattedDateString(),
                'link'=>$result->link,
                'credential'=>$certID,
                ];
            Mail::to($userEmail)->send(new CertificationComplete($mailable));
            return $pdf->download('Certificate - '.$certID.'.pdf');
        }
        else throw new NotFoundHttpException();
    }
    public function validateCert(Request $cert)
    {
        $cert=strip_tags($cert->validate(['certID'=>'bail|required|string|min:12|max:12|alpha_num|exists:results,certID'])['certID']);
        $result=Results::where('certID',$cert)->firstOrFail();
        $name=ucwords(strtolower($result->allowed_attempt->user->name));
        if($result->end_date>=now())
            $validation=true;
        else
            $validation=false;
        $data=['name'=>$name,'startDate'=>$result->start,'validTill'=>$result->end_date,'certificateID'=>$cert,'grade'=>$result->score,'isset'=>true,'isValid'=>$validation];
        return view('verifycert',$data);
    }
}
