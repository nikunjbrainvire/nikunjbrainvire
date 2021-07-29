<?php

namespace App\Http\Controllers;

use App\Models\bookmanagment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\Console\Input\Input;
use validate;

class BookmanagmentController extends Controller
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
        $this->validate($request,[
            'bookname'  =>  'required',
            'bookcategory'  =>  'required',
            'bookauthor'  =>  'required',
            'bookisbn'  =>  'required|alphaNum',
            'bookprice'  =>  'required|alphaNum',
            'file'  =>  'required|image'
        ]);


        $request->file('file')->store('public');
        $imgpath = "public/".$request->file('file')->hashName();

        // dd($request->file->getClientOriginalExtension());

        $bookmanagment = new bookmanagment();
        $bookmanagment->book_name = $request->input('bookname');
        $bookmanagment->book_Category = $request->input('bookcategory');
        $bookmanagment->book_Author = $request->input('bookauthor');
        $bookmanagment->book_isbn = $request->input('bookisbn');
        $bookmanagment->book_price = $request->input('bookprice');
        $bookmanagment->book_image = $imgpath;
        $bookmanagment->save();

        return redirect('/admin/viewbook')->with('errors','Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bookmanagment  $bookmanagment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $r)
    {
        if(isset($r->search) or isset($r->id)){
            $search = $r->search;
            $data = bookmanagment::where('book_name', 'LIKE', '%' . $search . '%')->orWhere('book_Category', 'LIKE', '%' . $search . '%')->orWhere('book_Author', 'LIKE', '%' . $search . '%')->paginate($r->id);

        } else {
            $data = bookmanagment::paginate(5);
        }

        return view('viewbook',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bookmanagment  $bookmanagment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editbook = bookmanagment::where('id',$id)->first();

        return view('editbook',['editbook'=>$editbook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bookmanagment  $bookmanagment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $this->validate($request,[
            'bookname'  =>  'required',
            'bookcategory'  =>  'required',
            'bookauthor'  =>  'required',
            'bookisbn'  =>  'required|alphaNum',
            'bookprice'  =>  'required|alphaNum'
        ]);

        if($request->file('file')){
            $this->validate($request,[
                'file'  =>  'image'
            ]);

            $request->file('file')->store('public');
            $imgpath = "public/".$request->file('file')->hashName();

            bookmanagment::where('id',$id)->update([
                'book_name'     => $request->bookname,
                'book_Category' => $request->bookcategory,
                'book_Author' => $request->bookauthor,
                'book_isbn' => $request->bookisbn,
                'book_price' => $request->bookprice,
                'book_image' => $imgpath
            ]);

        }
        else{
            bookmanagment::where('id',$id)->update([
                'book_name'     => $request->bookname,
                'book_Category' => $request->bookcategory,
                'book_Author' => $request->bookauthor,
                'book_isbn' => $request->bookisbn,
                'book_price' => $request->bookprice
            ]);
        }
        return redirect("/admin/viewbook")->with('errors','Data Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bookmanagment  $bookmanagment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bookmanagment::find($id)->delete();
        return redirect("/admin/viewbook")->with('errors','Data Delete Successfully');
    }
}
