<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;


class Check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        echo "<script>alert('asd');</script>";
                if(session::has('role'))
                {
                    echo "<script>alert('2');</script>";

                    if(Session::get('role') == 2)
                    {
                        return redirect('/admin/dashboard');
                        // return view('admindashboard');
                    }
                    if(Session::get('role') == 1)
                    {
                        return redirect('/user/dashboard2');
                    }

                    // return redirect('/admin/dashboard');
                }
                else{
                    return redirect('/');
                }

        // return view('login',['msg'=>' ']);

        return $next($request);
    }
}
