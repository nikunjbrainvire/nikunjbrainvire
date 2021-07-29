<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

class usermaster extends Controller
{
    public function create(request $r){

        $this->validate($r,[
            'name'          =>  'required',
            'email'         =>  'required|email',
            'password'      =>  'required|min:5',
            'cofirmpassword'=>  'required|min:5'
        ]);

        if($r->input('password') == $r->input('cofirmpassword')){
            $user = new user();
            $user->name = $r->name;
            $user->email = $r->email;
            $user->password = $r->password;
            $user->save();

            return redirect('/');
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

    public function destroy($id)
    {
        user::find($id)->delete();
        return redirect("/admin/viewuser")->with('errors','Data Delete Successfully');
    }

}
