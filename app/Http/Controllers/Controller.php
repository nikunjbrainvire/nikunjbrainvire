<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use PDF;
use App\Models\bookmanagment;
use App\Models\cart;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $to_name = "tset";
        $to_mail = "laraveltest572@gmail.com";

        // Mail::to('laraveltest572@gmail.com')->send(new SendMail($data));
        $dada = 'adasdasd';
        // $pdf = PDF::loadView('mail',compact('dada'));

        // $path = storage_path('test');
        // dd($path);
        // $pdf->save($path."\sadasd.pdf");




        $id=Session::get('useid');
        // $r->session()->get('addtocart');
        $data = bookmanagment::where(['id' => Session::get('addtocart')])->first();

        $users = DB::table('carts')
            ->join('bookmanagments', 'carts.book_id', '=', 'bookmanagments.id')
            ->select('bookmanagments.*')
            ->where('carts.user_id',$id)
            ->get();


            // Mail::to('laraveltest572@gmail.com')->send(new SendMail($data))
            // {
            //     $message->attach('path_to_pdf_file', array(
            //         'as' => 'pdf-report.zip',
            //         'mime' => 'application/pdf')
            //     );
            // }

            // Mail::send('emails.welcome', $data, function($message) use ($data)
            // {
            //     $message->to('mail@domain.net');
            //     $message->subject('Welcome to Laravel');
            //     $message->attach('path_to_pdf_file', array(
            //         'as' => 'pdf-report.zip',
            //         'mime' => 'application/pdf')
            //     );
            // });

            // $pdf = PDF::loadView('mail',compact('users'));

            // $path = storage_path('test');
            // $pdf->download('asd.pdf');
            // $pdf->save($path."\ssxzx2.pdf");
            // $data = array('name'=>'vikash','body'=>"test");

            // // $pdf = PDF::loadView('your_view_name', $data)->setPaper('a4');
            // Mail::send('mail', compact('users'), function($message) use ($pdf){
            //         $message->from('laraveltest572@gmail.com');
            //         $message->to('laraveltest572@gmail.com');
            //         $message->subject('Thank you message');
            //         //Attach PDF doc
            //         $message->attachData($pdf->output(),'customer.pdf');
            //     });


        return view('mail2',compact('users'));
    }

    public function testorder()
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
