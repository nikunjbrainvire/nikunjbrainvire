<?php

namespace App\Http\Controllers;

use App\Models\bookmanagment;
use App\Models\registermaster;
use App\Models\order;
use App\Models\user;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobExport;
use App\Exports\rangeExport;
use Excle;
use Illuminate\Support\Facades\Redirect;

class excelController extends Controller
{
    public function excel($id)
    {
        // dd($id);
        // $query = User::all();
        // $query=DB::table('users')
        // ->where('id',$id)
        // ->get();

        $query = DB::table('orders')
        ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('bookmanagments.*','users.*','orders.*')
        ->where('orders.user_id',$id)
        ->get();


        if($query->count() == 0){
            return Redirect('/admin/viewuserexcel')->with('errors','This User Not Borrowed Any Books');
        }

        // dd($query);
        return Excel::download(new JobExport($query), 'users.xlsx');

    }

    public function daterangeexcel(Request $r)
    {
        // dd($id);
        // $query = User::all();
        // $query=DB::table('users')
        // ->where('id',$id)
        // ->get();
        $method = $r->method();

        if($r->isMethod('post'))
        {

            // dd($r->startdate);
        $query = DB::table('orders')
        ->join('bookmanagments', 'orders.book_id', '=', 'bookmanagments.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('bookmanagments.*','users.*','orders.*')
        // ->where('orders.user_id',$id)
        ->whereBetween('orders.created_at', array($r->startdate, $r->enddate))
        ->get();

        return Excel::download(new JobExport($query), 'users.xlsx');

    }
        else{
            return view('daterangeuserexcel');
        }
        // dd($query);

        // if($query->count() == 0){
        //     return Redirect('/admin/viewuserexcel')->with('errors','This User Not Borrowed Any Books');
        // }

        // dd($query);


    }

    public function show(Request $r)
    {
        if(isset($r->search) or isset($r->id)){
            $search = $r->search;
            $data = user::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->paginate($r->id);

        } else {
            $data = user::paginate(5);
        }

        return view('viewuserexcel',['data'=>$data]);
    }
}
