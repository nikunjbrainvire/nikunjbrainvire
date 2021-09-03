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
    public function __construct(order $order,cart $cart)
    {
        $this->order = $order;
        $this->cart = $cart;
    }

    public function show()
    {
        $id=Session::get('useid');


        $users  = $this->order->userorder($id);




        return view('user.vieworder',['data'=>$users]);
    }


    public function getordernow(Request $r){

        $id=Session::get('useid');

        $users = $this->cart->getordernow($r->input(),$id);

        return view('user.ordernow',['data'=>$users]);

    }

    public function ordernow(Request $r){


        $this->validate($r,[
            'address'     =>  'required|min:10',
            'payment'  =>  'required'
        ]);


        $user_id = $r->session()->get('useid');
        $users = $this->cart->ordernow($r->input(),$user_id);




        $pdf = PDF::loadView('mail2',compact('users'));

        $path = storage_path('test');
        $pdf->download('asd.pdf');
        $pdf->save($path."\ssxzx2.pdf");
        $data = array('name'=>'vikash','body'=>"test");


        Mail::send('mail', compact('users'), function($message) use ($pdf){
                $message->from('laraveltest572@gmail.com');
                $message->to(Session::get('email'));
                $message->subject('you Invoice'.Session::get('username'));
                //Attach PDF doc
                $message->attachData($pdf->output(),'customer.pdf');
            });
            $result = cart::where(['user_id'=> Session::get('useid')])->delete();


        return redirect('/user/vieworder');

    }

    public function userorder()
    {

        $id=Session::get('useid');
        $users = $this->order->userorder($id);


            $pdf = PDF::loadView('user.orderspdf',compact('users'));




        return  $pdf->download('Bookhistory.pdf');

    }

}
