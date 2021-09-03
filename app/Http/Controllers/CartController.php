<?php

namespace App\Http\Controllers;

use App\Models\bookmanagment;
use App\Models\registermaster;
use App\Models\order;
use App\Models\user;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use validate;
use Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct(bookmanagment $book,cart $cart)
    {
        $this->book = $book;
        $this->cart = $cart;
    }

    public function useractionshow(Request $r)
    {

            $id=Session::get('useid');
            $result = cart::where(['user_id'=> Session::get('useid')])->get();
            $result2 = order::where(['user_id'=> Session::get('useid')])->get();
            $ca = [];
            $or = [];
            foreach ($result2 as $order)
            {
                array_push($or,$order['book_id']);
            }

            foreach ($result as $cart)
            {
                array_push($ca,$cart['book_id']);
            }

            if (in_array($r->addtocart, $or, TRUE))
            {
                return redirect('user/viewbook')->with('success','Book Already Borrowed');
            }
            if(in_array($r->addtocart, $ca, TRUE)){
                return redirect('user/viewbook')->with('success','You Maximum Limit Reached In Add To Cart For This Book');
            }

            if(isset($r->addtocart)){

                $r->session()->put('quantity',$r->input('quantity'));

                $this->cart->useractionshow($r->input(),$id);


            }


            return redirect('/user/viewbook');
    }

    public function usercart(Request $r){

        $id=Session::get('useid');

        $users = $this->cart->usercart($id);


        return view('user.viewcart',['data'=>$users]);
    }

    public function userorder(Request $r)
    {



        $id = $r->session()->get('addtocart');
        bookmanagment::where('id',$id)->update([
            'book_quantity' => $r->session()->get('quantity')-1
        ]);

        $userid = $r->session()->get('useid');

        user::where('id',$userid)->update([
            'order_bookid' => $id
        ]);

    }

    public function usershow(Request $r)
    {
        $data = $this->book->view($r->input());

        return view('user.viewbook',['data'=>$data]);
    }

    public function deletecart($id){

        $useid = Session::get('useid');
        $this->cart->deletecart($useid,$id);

        return redirect('/user/viewcart')->with('success','Remove From Add To Cart');
    }

}
