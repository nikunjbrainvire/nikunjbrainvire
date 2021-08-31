<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\registermaster;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Crypt;

class usermaster extends Controller
{

    public function profile(request $r ){
        $email = $r->session()->get('email');


        // $registermaster = registermaster::where('username',$email)->first();
        $user = user::where('email',$email)->first();
        // dd($user->name);

        return view('user.userprofile',['user'=>$user]);
    }

    public function create(request $r){

        $this->validate($r,[
            'name'          =>  'required',
            'email'         =>  'required|email',
            'password'      =>  'required|min:5',
            'cofirmpassword'=>  'required|min:5'
        ]);

        $encrypt = md5($r->password);

        if($r->input('password') == $r->input('cofirmpassword')){
            $user = new user();
            $user->name = $r->name;
            $user->email = $r->email;
            $user->password = $encrypt;
            $user->save();

            $registermaster = new registermaster();
            $registermaster->username = $r->email;
            $registermaster->password = $encrypt;
            $registermaster->role = 1;
            $registermaster->save();

            return redirect('/')->with('successs','Sign In Successfully');
        }
        else{
            return redirect('/register/user')->with('errors','Confirm Password Wrong');
        }

    }

    public function show(Request $r)
    {
        if(isset($r->search) or isset($r->id)){
            $search = $r->search;
            $data = user::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->paginate($r->id);

        } else {
            $data = user::paginate(5);
        }

        return view('viewuser',['data'=>$data]);
    }

    public function edit($id)
    {
        $edituser = user::where('id',$id)->first();

        return view('edituser',['editbook'=>$edituser]);
    }


    public function update(Request $request,$id)
    {

        $this->validate($request,[
            'name'  =>  'required',
            'email'  =>  'required',
            'password'  =>  'required',
            'cofirmpassword'  =>  'required'
        ]);

        if($request->input('password') == $request->input('cofirmpassword'))
        {

            user::where('id',$id)->update([
                'name'     => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        }else{
            return redirect('admin/edituser/'.$id)->with('errors','Invalid Confirm Password');
        }

            return redirect("/admin/viewuser")->with('errors','Data Update Successfully');

    }

    public function updateprofile(request $r){

        $this->validate($r,[
            'name'  =>  'required',
            'gender'  =>  'required',
            'address'  =>  'required'
        ]);

        $email = $r->session()->get('email');

        user::where('email',$email)->update([
            'name'     => $r->name,
            'gender' => $r->gender,
            'address' => $r->address
        ]);

        return redirect("/user/profile")->with('success','Profile Update Successfully');

    }

    public function changepass(request $r)
    {
        $this->validate($r,[
            'oldpass'     =>  'required',
            'newpass'     =>  'required|min:5',
            'confirmpass' =>  'required|min:5'
        ]);

        $email = $r->session()->get('email');
        $password = md5($r->input('oldpass'));

        $result = registermaster::where(['username' => $email, 'password' => $password] )->first();

        if($result){

            if($r->input('newpass') == $r->input('confirmpass'))
            {

                $encrypt = md5($r->input('confirmpass'));

                registermaster::where(['username' => $email, 'password' => $password] )->update([
                    'password'=> $encrypt
                ]);

                // dd(registermaster::where('password',$r->input('oldpass'))->update(['password'=> $r->input('confirmpass')],['username'=> 'admin@admin']));

                return redirect('/user/changepassword')->with('success','Change Password SuccessFully');
            }
            else{
                return redirect('/user/changepassword')->with('errors','Invalid Confirm Password');
            }
        }else{
            return redirect('/user/changepassword')->with('errors','Old Password Is Invalid');
        }
        return $r->input();
    }




}
