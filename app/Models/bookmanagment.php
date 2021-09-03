<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class bookmanagment extends Model
{
    use HasFactory;

    public function store($request,$imgpath){

        // dd($imgpath);

        $bookmanagment = new bookmanagment();
        $bookmanagment->book_name = $request['bookname'];
        $bookmanagment->book_Category = $request['bookcategory'];
        $bookmanagment->book_Author = $request['bookauthor'];
        $bookmanagment->book_isbn = $request['bookisbn'];
        $bookmanagment->book_price = $request['bookprice'];
        $bookmanagment->book_quantity = $request['bookquantity'];
        $bookmanagment->book_image = $imgpath;
        $bookmanagment->save();
    }

    public function view($request){
        // dd('asas');

        if(isset($request['search']) or isset($request['id'])){
            $search = $request['search'];
            $data = bookmanagment::where('book_name', 'LIKE', '%' . $search . '%')->orWhere('book_Category', 'LIKE', '%' . $search . '%')->orWhere('book_Author', 'LIKE', '%' . $search . '%')->paginate($request['id']);

        } else {

            $data = bookmanagment::paginate(5);
        }
        return $data;
    }

    public function edit($id){
        $editbook = bookmanagment::where('id',$id)->first();
        return $editbook;
    }

    public function updates($request,$imgpath,$id){

        if(!$imgpath == NULL){

        bookmanagment::where('id',$id)->update([
            'book_name'     => $request['bookname'],
            'book_Category' => $request['bookcategory'],
            'book_Author' => $request['bookauthor'],
            'book_isbn' => $request['bookisbn'],
            'book_price' => $request['bookprice'],
            'book_quantity' => $request['bookquantity'],
            'book_image' => $imgpath
        ]);
    }
    else{
        bookmanagment::where('id',$id)->update([
            'book_name'     => $request['bookname'],
            'book_Category' => $request['bookcategory'],
            'book_Author' => $request['bookauthor'],
            'book_isbn' => $request['bookisbn'],
            'book_price' => $request['bookprice'],
            'book_quantity' => $request['bookquantity']
        ]);
    }

    }

    public function bookdelete($id){

        bookmanagment::find($id)->delete();

    }

    public function showbookrecord($request){

        if(isset($request['search']) or isset($request['id'])){
            $search = $request['search'];
            // $search = !$request['search']?NULL:$request['search'];

            $data = Order::join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
            // ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('bookmanagments.*','users.*','orders.*')
            ->orwhere('users.name','like','%'.$search.'%')
            ->orwhere('users.email','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_name','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_Category','like','%'.$search.'%')
            ->orwhere('bookmanagments.book_Author','like','%'.$search.'%')
            ->paginate($request['id']);

           }
           else{
           $data = Order::join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        //    ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
           ->join('users', 'orders.user_id', '=', 'users.id')
           ->select('bookmanagments.*','users.*','orders.*')
           // ->where('users.name','like','%%')
           // ->where('users.email','like','%mixpatel13@gmail.com%')
           ->paginate(5);
           }
           return $data;
    }

    public function editbookrecord($id){
        $data = Order::join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
    //    ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
       ->join('users', 'orders.user_id', '=', 'users.id')
       ->select('bookmanagments.*','users.*','orders.*')
       ->where('orders.id',$id)
       ->get();
       return $data;
    }

    public function updatebookquntity($request,$id){
        bookmanagment::where('id',$request['upid'])->update([
            'book_quantity' => $request['quantity']+1
        ]);
    }


}
