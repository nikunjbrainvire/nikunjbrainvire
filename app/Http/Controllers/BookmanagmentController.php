<?php

namespace App\Http\Controllers;

use App\Models\Bookmanagment;
use App\Models\registermaster;
use App\Models\user;
use App\Models\cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\Console\Input\Input;
use validate;
use Illuminate\Support\Facades\DB;

class BookmanagmentController extends Controller
{

    public function __construct(bookmanagment $book)
    {
        $this->book = $book;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'bookname'  =>  'required',
            'bookcategory'  =>  'required',
            'bookauthor'  =>  'required',
            'bookisbn'  =>  'required|alphaNum',
            'bookprice'  =>  'required|alphaNum',
            'bookquantity' => 'required|alphaNum',
            'file'  =>  'required|image'
        ]);


        $request->file('file')->store('public');
        $imgpath = "public/".$request->file('file')->hashName();

        $result = $this->book->store($request->input(),$imgpath);

        return redirect('/admin/viewbook')->with('errors','Data Insert Successfully');
    }

    public function show(Request $r)
    {

        $data = $this->book->view($r->input());

        return view('viewbook',['data'=>$data]);
    }
    public function edit($id)
    {
        $editbook = $this->book->edit($id);


        return view('editbook',['editbook'=>$editbook]);
    }

    public function update(Request $request,$id)
    {

        $this->validate($request,[
            'bookname'  =>  'required',
            'bookcategory'  =>  'required',
            'bookauthor'  =>  'required',
            'bookisbn'  =>  'required|alphaNum',
            'bookquantity' => 'required|alphaNum',
            'bookprice'  =>  'required|alphaNum'
        ]);

        if($request->file('file')){
            $this->validate($request,[
                'file'  =>  'image'
            ]);

            $request->file('file')->store('public');
            $imgpath = "public/".$request->file('file')->hashName();

            $this->book->updates($request->input(),$imgpath,$id);



        }
        else{
            $this->book->updates($request->input(),$imgpath=NULL,$id);

        }
        return redirect("/admin/viewbook")->with('errors','Data Update Successfully');

    }


    public function destroy($id)
    {
        $this->book->bookdelete($id);

        return redirect("/admin/viewbook")->with('errors','Data Delete Successfully');
    }



    public function usercart(Request $r){

        $r->session()->get('addtocart');
        $data = bookmanagment::where(['id' => $r->session()->get('addtocart')])->first();


        return view('user.viewcart',['data'=>$data]);
    }




}
