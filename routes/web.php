<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookmanagmentController;
use App\Http\Controllers\usermaster;
use App\Models\registermaster;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Cookie;

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
    if(session()->has('email'))
    {
        return redirect('/admin/dashboard');
    }
    return view('login',['msg'=>' ']);
});


Route::post('/',[RegisterController::class, 'UserAuth']);


Route::get('/test', function() {
    return view('test');
} );



Route::get('/admin/dashboard', function () {

    if(session()->has('email'))
    {
        return view('admindashboard');
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

Route::get('/logout', function() {
    session()->forget('email');
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
