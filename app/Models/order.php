<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function returnbookupdate($request,$id){

        order::where('id',$id)->update([
            'returnbook_date' => $request['returnbook']
        ]);

    }

    public function excel($id){
        $query = Order::join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('bookmanagments.*','users.*','orders.*')
        ->where('orders.user_id',$id)
        ->get();
        return $query;
    }

    public function daterangeexcel($request){
        $query = Order::join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('bookmanagments.*','users.*','orders.*')
        ->whereBetween('orders.created_at', array($request['startdate'], $request['enddate']))
        ->get();
        return $query;
    }

    public function userorder($id){
        $users = Order::where('user_id',$id)
        ->whereNull('returnbook_date')
        ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->select('bookmanagments.*')
        ->get();
        return $users;
    }
}
