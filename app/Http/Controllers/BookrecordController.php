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

    public function __construct(bookmanagment $book,order $order)
    {
        $this->book = $book;
        $this->order = $order;
    }

    public function show(Request $r)
    {

        $data = $this->book->showbookrecord($r->input());



   return view('bookrecord',['data'=>$data]);
    }
    public function edit($id)
    {
        $data = $this->book->editbookrecord($id);

        return view('editbookrecord',['editbook'=>$data]);
    }

    public function update(Request $request,$id)
    {

        $this->validate($request,[
            'returnbook'  =>  'required'
        ]);

        $this->order->returnbookupdate($request->input(),$id);

        $this->book->updatebookquntity($request->input(),$id);




        return redirect("/admin/record")->with('success','Returndate Insert Successfully');

    }




}
