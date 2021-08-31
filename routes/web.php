<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookmanagmentController;
use App\Http\Controllers\BookrecordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DateRangeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\usermaster;
use App\Http\Controllers\excelController;
use App\Models\bookmanagment;
use App\Models\registermaster;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

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


Route::post('/',[RegisterController::class, 'UserAuth']);


Route::get('/test', function() {
    return view('test');
} );



Route::get('/admin/dashboard', function () {

    if(session()->get('role') == 2)
    {
        return view('admindashboard');
    }
    elseif(session()->get('role') == 1)
    {
        return redirect('/user/dashboard2');
    }
    return redirect('/');
});



Route::post('/admin/addbook',[BookmanagmentController::class, 'store']);



Route::get('/admin/addbook', function() {
    return view('addbook');
} );

Route::get('/admin/changepassword', function() {
    return view('changepassword');
} );

Route::post('/admin/changepassword',[RegisterController::class, 'changepass'])->name('admin.changePassword');

Route::get('/admin/viewbook',[BookmanagmentController::class, 'show']);



Route::get('/admin/editbook/{id}',[BookmanagmentController::class, 'edit']);

Route::post('/admin/updatebook/{id}',[BookmanagmentController::class, 'update']);

Route::get('/admin/deletebook/{id}',[BookmanagmentController::class, 'destroy']);

Route::get('/admin/bookhistory',[BookmanagmentController::class, 'bookhistory']);

Route::get('/logout', function() {
    session()->forget('email');
    session()->forget('role');
    session()->forget('username');
    return redirect('');
});

Route::get('/register/user', function() {
    return view('user');
} );


Route::post('/register/user',[usermaster::class, 'create']);

Route::get('/admin/viewuser',[usermaster::class, 'show']);

Route::get('/admin/edituser/{id}',[usermaster::class, 'edit']);

Route::post('/admin/updatuser/{id}',[usermaster::class, 'update']);

Route::get('/admin/deleteuser/{id}',[usermaster::class, 'destroy']);

Route::get('/admin/viewuserexcel',[excelController::class, 'show']);


//user root

Route::get('/user/dashboard2', function () {
    // dd(session()->has('role'));
    if(session()->get('role') == 2)
    {
        return redirect('/admin/dashboard');
    }
    elseif(session()->get('role') == 1)
    {
        return view('user.userdashboard');
    }
    return redirect('/');
});

Route::get('/user/profile',[usermaster::class, 'profile']);


Route::post('/user/profile',[usermaster::class, 'updateprofile']);
Route::get('/user/changepassword', function() {
    return view('user.changepassword');
} );


Route::get('/user/viewbook',[CartController::class, 'usershow']);

Route::get('/user/viewcart',[CartController::class, 'usercart']);

// Route::get('/user/ordernow',[CartController::class, 'userorder']);


Route::post('/user/viewbook',[CartController::class, 'useractionshow']);
Route::get('/user/deletecart/{id}',[CartController::class, 'deletecart']);


Route::post('/user/changepassword',[book::class, 'changepass'])->name('user.changePassword');



//Order Now root

Route::get('/user/ordernow',[OrderController::class, 'getordernow']);

Route::get('/user/vieworder',[OrderController::class, 'show']);

Route::post('/user/ordernow',[OrderController::class, 'ordernow']);

Route::get('/mail',[Controller::class, 'index']);

//test

Route::get('user/orderpdf',[OrderController::class, 'userorder']);

//record admin

Route::get('admin/record',[BookrecordController::class, 'show']);

Route::get('admin/editrecord/{id}',[BookrecordController::class, 'edit']);

Route::post('admin/editrecord/{id}',[BookrecordController::class, 'update']);

Route::get('admin/bookhistory',[BookrecordController::class, 'bookhistory']);

Route::get('admin/returneditbookrecord/{id}',[BookrecordController::class, 'retunedit']);

Route::post('admin/returneditbookrecord/{id}',[BookrecordController::class, 'returnupdate']);

Route::get('admin/downloadexcel/{id}',[excelController::class, 'excel']);

Route::get('admin/range',[excelController::class, 'daterangeexcel']);

Route::post('admin/range',[excelController::class, 'daterangeexcel']);

