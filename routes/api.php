<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usermaster;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("test",[usermaster::class,'apitest']);

Route::get('/', function () {
    if(session()->get('role') == 2)
    {
        return redirect('/admin/dashboard');
    }
    elseif(session()->get('role') == 1)
    {
        return redirect('/user/dashboard2');
    }
    return view('login',['msg'=>' ']);
});
