<?php

namespace App\Http\Controllers;

use App\AllowedAttempt;
use App\User;
use Illuminate\Http\Request;

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
    public function index()
    {
//        $data=[
//            'testName'=>,
//            'testID'=>,
//        ];
        return view('attempt',['testName'=>'Test']);
    }
    public function AllUnAttempted()
    {
        $appUser= User::getCurrentAPIUser();
        return AllowedAttempt::where('user_id',$appUser['id'])->get();
    }
}
