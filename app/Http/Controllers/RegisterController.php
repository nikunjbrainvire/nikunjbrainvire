<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registermaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use validate;
use Auth;
use Illuminate\Support\Facades\Cookie;

class RegisterController extends Controller
{
    function UserAuth(request $r)
    {

        $this->validate($r,[
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:3'
        ]);

        $result = registermaster::where(['username'=> $r->input('email'),'password' => $r->input('password')])->first();

        if($result){

            if($result->role == 2){

                $r->session()->put('email',$r->input('email'));
                $r->session()->put('role',$result->role);

                // Cookie::make('name', $r->input('email'), 15);


                return redirect('/admin/dashboard');
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
                registermaster::where('password',$r->input('oldpass'))->update([
                    'password'=> $r->input('confirmpass')
                ]);

                // dd(registermaster::where('password',$r->input('oldpass'))->update(['password'=> $r->input('confirmpass')],['username'=> 'admin@admin']));

                return redirect('/admin/changepassword')->with('errors','Change Password SuccessFully');
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
