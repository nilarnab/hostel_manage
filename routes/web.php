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
Route::get('/home_hostel', 'hostel_home_manage@index')->middleware('HostelGuard');

// route for changing room
Route::get('/change_room', 'hostel_home_manage@change_room')->middleware('auth');

// route for updating profile
Route::get('/change_profile_hosteler', function ()
{
    return view('update_profile');
})->middleware('auth');

// admin panel
Route::get('/admin_panel', 'hostel_home_manage@admin_panel')->middleware('auth', 'AdminGuard');

// route for mess secretary
Route::get('/mess_secretary', 'hostel_home_manage@mess_manage')->middleware('auth', 'MessGuard');

// route for food provider
//Route::get('/food_provider', 'hostel_home_manage@mess_manage')->middleware('auth', 'FoodProviderGuard');

// route for changing roles
Route::get('/update_role', 'hostel_home_manage@update_role')->middleware('auth');

// logout
Route::get('/logout', function ()
{
    Auth::logout();
    echo "logged out";
    return redirect("/");
});


// testing for mail
Route::get('/mailer', function ()
{
    return view('mailer');
});

Route::get('/testing', 'hostel_home_manage@testing');

// POST REQUESTS
Route::post('/change_hosteler_profile', 'hostel_home_manage@change_profile')->middleware('auth');
Route::post('/change_room_handle', 'hostel_home_manage@change_room_handle');
Route::post('/change_time', 'hostel_home_manage@update_timing');
Route::post('/change_menue', 'hostel_home_manage@update_menue');
Route::post('/add_food', 'hostel_home_manage@add_food');
Route::post('/delete_food', 'hostel_home_manage@delete_food');
Route::post('/delete_timing', 'hostel_home_manage@delete_timing');
Route::get('/update_profile', 'hostel_home_manage@update_profile_manage');
Route::post('/update_profile_act', 'hostel_home_manage@update_profile');
Route::post('/update_photo', 'hostel_home_manage@upload_photo');
Route::post('/handle_mail', 'hostel_home_manage@handle_mail');
Route::post('/update_role_ajax', 'hostel_home_manage@update_role_request');
Route::post('/create_room', 'hostel_home_manage@create_room');

// route for ajax
Route::get('/ajax_approve', 'hostel_home_manage@approve_hosteler');
Route::get('/ajax_deny', 'hostel_home_manage@deny_hosteler');
Route::get('/ajax_approval', 'hostel_home_manage@approval');
Route::get('/ajax_room_approval', 'hostel_home_manage@room_approval');

// testing
Route::get('/speed_test', 'hostel_home_manage@query_speed');
Route::get('/create_room_test', 'hostel_home_manage@create_room');


