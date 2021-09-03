<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    public function show($request){

        if(isset($request['search']) or isset($request['id'])){
            $search = $request['search'];
            $data = user::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->paginate($request['id']);


        } else {

            $data = user::paginate(5);
        }
        return $data;
    }

    public function edit($id){
        $edituser = user::where('id',$id)->first();
        return $edituser;
    }

    public function userupdate($request,$id){


        user::where('id',$id)->update([
            'name'     => $request['name'],
            'email' => $request['email'],

        ]);
    }
}
