<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class cart extends Model
{
    use HasFactory;

    public function usercart($id){
        $users = Cart::where('user_id',$id)
        ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
        ->select('bookmanagments.*','carts.*')
        ->get();
        return $users;
    }

    public function useractionshow($request,$id){

        $cart = new cart();
        $cart->book_id = $request['addtocart'];
        $cart->user_id = $id;
        $cart->save();
    }

    public function getordernow($request,$id){
        $users = Cart::where('user_id',$id)
        ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
        ->select('bookmanagments.*')
        ->get();
        return $users;
    }

    public function ordernow($r,$id){


         $allcart = Cart::where('user_id',$id)
                ->join('bookmanagments','carts.book_id', '=', 'bookmanagments.id')
                ->get();

        foreach($allcart as $cart)
        {
            // dd();

        $order = new order();
        $order->book_id = $cart['book_id'];
        $order->user_id = $cart['user_id'];
        $order->address = $r['address'];
        $order->status = 'Pendding';
        $order->payment_method = $r['payment'];
        $order->save();


        bookmanagment::where('id',$cart->book_id)->update([
        'book_quantity' => $cart->book_quantity-1
        ]);


        }

        $users = Cart::where('user_id',$id)
            ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*')
            ->get();

            return $users;

    }

    public function deletecart($useid,$id){
         cart::where(['user_id'=> $useid,'id' => $id])->delete();

    }

}
