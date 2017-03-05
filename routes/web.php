<?php

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

// Testing =================================================

Route::get('test1', function () {
	$var = DB::select("SELECT email FROM user WHERE user_type = 'authed';");
	$var = array_map('Help::_pullOutEmails', $var);
  return "<pre>" . print_r($var, true) . "</pre>";
});


Route::get('test2', function () {
	// return \DB::select("SELECT MAX(id) FROM user;")[0]->id;
});





// Start ===================================================

Route::get('/', function(){return redirect('start');});
Route::get('start', function(){return view('start');});



// Auth ====================================================

Route::get('auth', "AuthController@getCreate");
Route::post('auth', "AuthController@postCreate");

Route::get('auth/login', "AuthController@getLogin");
Route::post('auth/login', "AuthController@postLogin");
Route::get('auth/logout', "AuthController@getLogout");
