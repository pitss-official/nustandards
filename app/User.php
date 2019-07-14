<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible=['college_id','college_name','email','name','id','fathers_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //this function will return the current user (api user) object
    public static function getCurrentAPIUser()
    {
        try{
            $userObject=Auth::guard('api')->user();
            return
                [
                'college_id'=>$userObject->college_id,
                'college_name'=>$userObject->college_name,
                'email'=>$userObject->email,
                'name'=>$userObject->name,
                'id'=>$userObject->id,
                'fathers_name'=>$userObject->fathers_name,
            ];
        }
        catch (\Exception $e)
        {
            die("Invalid Session");
        }
    }
}
