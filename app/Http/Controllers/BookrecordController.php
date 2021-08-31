<?php

namespace App\Http\Controllers;

use App\Models\bookrecord;
use Illuminate\Http\Request;
use App\Models\bookmanagment;
use App\Models\registermaster;
use App\Models\user;
use App\Models\cart;
use App\Models\order;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Support\Facades\DB;
use App\Exports\Export;
use Excel;

class BookrecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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
     * @param  \App\Models\bookrecord  $bookrecord
     * @return \Illuminate\Http\Response
     */
    public function show(Request $r)
    {
       // DB::enableQueryLog();

       if(isset($r->search) or isset($r->id)){
        $search = $r->search;
        $data = DB::table('orders')
        ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('bookmanagments.*','users.*','orders.*')
        ->orwhere('users.name','like','%'.$search.'%')
        ->orwhere('users.email','like','%'.$search.'%')
        ->orwhere('bookmanagments.book_name','like','%'.$search.'%')
        ->orwhere('bookmanagments.book_Category','like','%'.$search.'%')
        ->orwhere('bookmanagments.book_Author','like','%'.$search.'%')
        ->paginate($r->id);

       }
       else{
       $data = DB::table('orders')
       ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
       ->join('users', 'orders.user_id', '=', 'users.id')
       ->select('bookmanagments.*','users.*','orders.*')
       // ->where('users.name','like','%%')
       // ->where('users.email','like','%mixpatel13@gmail.com%')
       ->paginate(5);
       }

   // dd(DB::getQueryLog());
// dd($data);
   return view('bookrecord',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bookrecord  $bookrecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);

        $data = DB::table('orders')
       ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
       ->join('users', 'orders.user_id', '=', 'users.id')
       ->select('bookmanagments.*','users.*','orders.*')
       ->where('orders.id',$id)
       ->get();

        // dd($data);

        return view('editbookrecord',['editbook'=>$data]);
    }

    public function update(Request $request,$id)
    {
        // dd(url()->current());

        $this->validate($request,[
            'returnbook'  =>  'required'
        ]);

        order::where('id',$id)->update([
            'returnbook_date' => $request->returnbook
        ]);

        return redirect("/admin/record")->with('success','Returndate Insert Successfully');

    }

    public function bookhistory(Request $r){

        if(isset($r->search) or isset($r->id)){
            $search = $r->search;
            $data = DB::table('orders')
            ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('bookmanagments.*','users.*','orders.*')
            ->orwhere('users.name','like','%'.$search.'%')
            ->orwhere('users.email','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_name','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_Category','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_Author','like','%'.$search.'%')
            ->whereNotNull('orders.returnbook_date')
            ->paginate($r->id);

           }
           else{
           $data = DB::table('orders')
           ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
           ->join('users', 'orders.user_id', '=', 'users.id')
           ->select('bookmanagments.*','users.*','orders.*')
           ->whereNotNull('orders.returnbook_date')
           // ->where('users.name','like','%%')
           // ->where('users.email','like','%mixpatel13@gmail.com%')
           ->paginate(5);
           }

   return view('historybookrecord',['data'=>$data]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bookrecord  $bookrecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(bookrecord $bookrecord)
    {
        //
    }

    public function retunedit($id)
    {
        // dd($id);

        $data = DB::table('orders')
       ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
       ->join('users', 'orders.user_id', '=', 'users.id')
       ->select('bookmanagments.*','users.*','orders.*')
       ->where('orders.id',$id)
       ->get();

        // dd($data);

        return view('returneditbookrecord',['editbook'=>$data]);
    }

    public function returnupdate(Request $request,$id)
    {
        // dd(url()->current());

        $this->validate($request,[
            'returnbook'  =>  'required'
        ]);

        order::where('id',$id)->update([
            'returnbook_date' => $request->returnbook
        ]);

        return redirect("/admin/bookhistory")->with('success','Returndate Insert Successfully');

    }



}
