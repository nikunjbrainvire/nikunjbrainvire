<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registermaster;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use validate;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;


class RegisterController extends Controller
{
    public function __construct(registermaster $register)
    {
        $this->register = $register;
    }

    function UserAuth(request $r)
    {

        $this->validate($r,[
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:3'
        ]);

        $result = $this->register->login($r->input());

        if($result){
            $r->session()->put('email',$r->input('email'));
            $r->session()->put('role',$result->role);

            if($result->role == 2){
                $r->session()->put('admin',$r->email);
                return redirect('/admin/dashboard');

            }
            elseif($result->role == 1){

                $userresult = user::where(['email'=> $r->input('email')])->first();
                $r->session()->put('username',$userresult->name);
                $r->session()->put('useid',$userresult->id);

                return redirect('/user/dashboard2');
            }

        }

        else{

            return redirect('/')->with('errors','Email or Password Wrong');
        }

    }

    public function changepass(request $r)
    {
        $this->validate($r,[
            'oldpass'     =>  'required',
            'newpass'     =>  'required|min:5',
            'confirmpass' =>  'required|min:5'
        ]);


        $result = $this->register->checkdata($r->input());

        if($result){

            if($r->input('newpass') == $r->input('confirmpass'))
            {

                 $this->register->updatedata($r->input());

                return redirect('/admin/changepassword')->with('success','Change Password SuccessFully');
            }
            else{
                return redirect('/admin/changepassword')->with('errors','Invalid Confirm Password');
            }
        }else{
            return redirect('/admin/changepassword')->with('errors','Invalid Oldpassword');
        }
        return $r->input();
    }


}
