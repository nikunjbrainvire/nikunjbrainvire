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
    public function __construct(user $user,order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }


    public function excel($id)
    {


        $query = $this->order->excel($id);



        if($query->count() == 0){
            return Redirect('/admin/viewuserexcel')->with('errors','This User Not Borrowed Any Books');
        }

        return Excel::download(new JobExport($query), 'users.xlsx');

    }

    public function daterangeexcel(Request $r)
    {

        $method = $r->method();

        if($r->isMethod('post'))
        {

            $query = $this->order->daterangeexcel($r->input());


        return Excel::download(new JobExport($query), 'users.xlsx');

    }
        else{
            return view('daterangeuserexcel');
        }


    }

    public function show(Request $r)
    {
        $data = $this->user->show($r->input());


        return view('viewuserexcel',['data'=>$data]);
    }
}
