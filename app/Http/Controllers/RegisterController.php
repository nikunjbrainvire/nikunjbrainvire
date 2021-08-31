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
    function UserAuth(request $r)
    {

        $this->validate($r,[
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:3'
        ]);

        $encrypt = md5($r->password);


        $result = registermaster::where(['username'=> $r->input('email'),'password' => $encrypt])->first();


        if($result){
            $r->session()->put('email',$r->input('email'));
            $r->session()->put('role',$result->role);

            if($result->role == 2){
                // Cookie::make('name', $r->input('email'), 15);
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

        $result = registermaster::where(['password' => $r->input('oldpass')])->first();

        if($result){

            if($r->input('newpass') == $r->input('confirmpass'))
            {

                $encrypt = md5($r->input('confirmpass'));
                registermaster::where('password',$r->input('oldpass'))->update([
                    'password'=> $encrypt
                ]);

                // dd(registermaster::where('password',$r->input('oldpass'))->update(['password'=> $r->input('confirmpass')],['username'=> 'admin@admin']));

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
