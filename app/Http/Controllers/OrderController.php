<?php

namespace App\Http\Controllers;

use App\Models\bookmanagment;
use App\Models\registermaster;
use App\Models\user;
use App\Models\cart;
use App\Models\order;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use PDF;

class OrderController extends Controller
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
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id=Session::get('useid');

        // $r->session()->get('addtocart');
        // $data = bookmanagment::where(['id' => Session::get('addtocart')])->first();

        $users = DB::table('orders')
            ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*')
            ->where('orders.user_id',$id)
            ->get();



        return view('user.vieworder',['data'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }



    public function getordernow(Request $r){

        $id=Session::get('useid');
        $r->session()->get('addtocart');
        $data = bookmanagment::where(['id' => $r->session()->get('addtocart')])->first();

        $users = DB::table('carts')
            ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*')
            ->where('carts.user_id',$id)
            ->get();

// dd($data->book_name);
        // dd($r->session()->get('quantity'));




        return view('user.ordernow',['data'=>$users]);

    }

    public function ordernow(Request $r){


        $this->validate($r,[
            'address'     =>  'required|min:10',
            'payment'  =>  'required'
        ]);

        $user_id = $r->session()->get('useid');
        $allcart = Cart::where('user_id',$user_id)->get();


        foreach($allcart as $cart)
        {

        $order = new order();
        $order->book_id = $cart['book_id'];
        $order->user_id = $cart['user_id'];
        $order->address = $r->input('address');
        $order->status = 'Pendding';
        $order->payment_method = $r->input('payment');
        $order->save();

        }


        $id=Session::get('useid');
        $data = bookmanagment::where(['id' => $r->session()->get('addtocart')])->first();

        $users = DB::table('carts')
            ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*')
            ->where('carts.user_id',$id)
            ->get();

        $pdf = PDF::loadView('mail2',compact('users'));

        $path = storage_path('test');
        $pdf->download('asd.pdf');
        $pdf->save($path."\ssxzx2.pdf");
        $data = array('name'=>'vikash','body'=>"test");

        // $pdf = PDF::loadView('your_view_name', $data)->setPaper('a4');
        Mail::send('mail', compact('users'), function($message) use ($pdf){
                $message->from('laraveltest572@gmail.com');
                $message->to(Session::get('email'));
                $message->subject('you Invoice'.Session::get('username'));
                //Attach PDF doc
                $message->attachData($pdf->output(),'customer.pdf');
            });
            $result = cart::where(['user_id'=> Session::get('useid')])->delete();
        // $data = array('name'=>'vikash','body'=>"test");

        // Mail::to('laraveltest572@gmail.com')->send(new SendMail($data));



        return redirect('/user/vieworder');

    }

    public function userorder()
    {

        $id=Session::get('useid');

        $users = DB::table('orders')
            ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*','orders.*')
            ->where('orders.user_id',$id)
            ->get();

//            dd($users);

            $pdf = PDF::loadView('user.orderspdf',compact('users'));

            // $path = storage_path('test');



        return  $pdf->download('Bookhistory.pdf');

    }

}
