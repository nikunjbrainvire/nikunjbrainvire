<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Auth;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class registermaster extends Authenticatable
{
    use HasFactory;

    public function login($input)
    {

        $encrypt= md5($input['password']);

        $result = registermaster::where(['username'=> $input['email'],'password' => $encrypt])->first();

        return $result;
    }

    public function checkdata($input){
        $encrypt = md5($input['oldpass']);

        $result = registermaster::where(['username'=>Session::get('admin'),'password' => $encrypt])->first();
        return $result;
    }

    public function updatedata($input){


        $encrypt = md5($input['confirmpass']);
        registermaster::where('password',$input['oldpass'])->update([
            'password'=> $encrypt
        ]);
        // return $result;
    }

    public function userchangepass($email,$password){
        $result = registermaster::where(['username' => $email, 'password' => $password] )->first();
        return $result;
    }

    public function updateuserpassword($email,$password,$encrypt){
        registermaster::where(['username' => $email, 'password' => $password] )->update([
            'password'=> $encrypt
        ]);

    }



}
