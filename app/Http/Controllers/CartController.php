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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }

    public function useractionshow(Request $r)
    {
            echo "sadasd";


            if(isset($r->addtocart)){

                $r->session()->put('quantity',$r->input('quantity'));
                $r->session()->put('addtocart',$r->input('addtocart'));

                $cart = new cart();
                $cart->book_id = Session::get('addtocart');
                $cart->user_id = Session::get('useid');
                $cart->save();

                $id = $r->session()->get('addtocart');
                    bookmanagment::where('id',$id)->update([
                    'book_quantity' => $r->session()->get('quantity')-1
                ]);

            }


            return redirect('/user/viewbook');
    }

    public function usercart(Request $r){

        $id=Session::get('useid');
        $r->session()->get('addtocart');
        $data = bookmanagment::where(['id' => $r->session()->get('addtocart')])->first();

        $users = DB::table('carts')
            ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*','carts.*')
            ->where('carts.user_id',$id)
            ->get();

// dd($data->book_name);
        // dd($r->session()->get('quantity'));


        return view('user.viewcart',['data'=>$users]);
    }

    public function userorder(Request $r)
    {


        // dd($r->session()->get('addtocart'));
        $id = $r->session()->get('addtocart');
        bookmanagment::where('id',$id)->update([
            'book_quantity' => $r->session()->get('quantity')-1
        ]);

        $userid = $r->session()->get('useid');
        // dd($userid);
        user::where('id',$userid)->update([
            'order_bookid' => $id
        ]);

    }

    public function usershow(Request $r)
    {

        if(isset($r->search) or isset($r->id)){
            $search = $r->search;
            $data = bookmanagment::where('book_name', 'LIKE', '%' . $search . '%')->orWhere('book_Category', 'LIKE', '%' . $search . '%')->orWhere('book_Author', 'LIKE', '%' . $search . '%')->paginate($r->id);

        } else {
            $data = bookmanagment::paginate(6);
        }

        $id=Session::get('useid');
        $result = cart::where(['user_id'=> Session::get('useid')])->get();
        $result2 = order::where(['user_id'=> Session::get('useid')])->get();
        $ca = [];
        $or = [];
        foreach ($result2 as $order)
        {
            array_push($or,$order['book_id']);
        }
        Session::put('orders',$or);

        foreach ($result as $cart)
        {
            array_push($ca,$cart['book_id']);
        }
        Session::put('carts',$ca);

        if (in_array('10', Session::get('orders'), TRUE) or in_array('10', Session::get('carts'), TRUE))
        {
        echo "found \n";
        }

        // foreach ($data as $datas){
        //     $s = "".$datas['book_name']."";
        //     echo "<br>";
        //     echo gettype($s);
        //     echo ($s);
        //     if (in_array($s, Session::get('orders'), TRUE))
        //     {
        //         echo ('$s');
        //     }


        // }

        // dd('success');
        return view('user.viewbook',['data'=>$data]);
    }

    public function deletecart($id){

        // $result = cart::where(['user_id'=> Session::get('useid'),'id' => $id])->delete();

        $result2 = cart::where(['user_id'=> Session::get('useid'),'id' => $id])->first();
        // dd($result2->book_id);

        $result3 = bookmanagment::where(['id' => $result2->book_id])->first();
        // dd($result3->book_quantity);
        bookmanagment::where('id',$result2->book_id)->update([
            'book_quantity' => $result3->book_quantity+1
        ]);

        $result = cart::where(['user_id'=> Session::get('useid'),'id' => $id])->delete();


        return redirect('/user/viewcart')->with('success','Remove From Add To Cart');
    }

}
