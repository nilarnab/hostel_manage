<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'loginRoute');


/* HOSTELERS PAGE ROUTEs
_____________________________________________________________*/

//GET REQUESTS

// home page for hostel
Route::get('/home_hostel', 'hostel_home_manage@index')->middleware('auth');

// route for changing room
Route::get('/change_room', 'hostel_home_manage@change_room')->middleware('auth');

// route for updating profile
Route::get('/change_profile_hosteler', function ()
{
    return view('update_profile');
})->middleware('auth');

// admin panel
Route::get('/admin_panel', 'hostel_home_manage@admin_panel')->middleware('auth');

// route for mess secretary
Route::get('/mess_secretary', 'hostel_home_manage@mess_manage')->middleware('auth');

// logout
Route::get('/logout', function ()
{
    Auth::logout();
    echo "logged out";
    return redirect("/");
});

// POST REQUESTS
Route::post('/change_hosteler_profile', 'hostel_home_manage@change_profile')->middleware('auth');
Route::post('/change_room_handle', 'hostel_home_manage@change_room_handle');
Route::post('/change_time', 'hostel_home_manage@update_timing');
Route::post('/change_menue', 'hostel_home_manage@update_menue');
Route::post('/add_food', 'hostel_home_manage@add_food');
Route::post('/delete_food', 'hostel_home_manage@delete_food');
Route::post('/delete_timing', 'hostel_home_manage@delete_timing');

// route for ajax
Route::get('/ajax_approve', 'hostel_home_manage@approve_hosteler');
Route::get('/ajax_deny', 'hostel_home_manage@deny_hosteler');

// route for testing purpose
Route::get('/testing', function ()
{
    return view('testing');
}
);

