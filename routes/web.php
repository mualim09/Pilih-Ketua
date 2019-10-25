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



// ------------ ROUTE WEBSITE USERS ------------------------ //


// view pemilihan
Route::get('/','UserController@pemilihan')->name('user.pemilihan')->middleware('user');
// view login user
Route::get('/login','UserController@login')->name('user.login')->middleware('notUser');
// autentikasi login user
Route::post('/login/auth','UserController@auth')->name('user.auth')->middleware('notUser');
// logout user
Route::get('/logout','UserController@logout')->name('user.logout')->middleware('user');
// cek apakah pemilihan masih aktif atau sudah ditutup
Route::get('/api/active','UserController@checkActive')->name('pemilihan.active');
// fungsi user pas milih
Route::post('/pilih','UserController@pilih')->name('user.pilih');
// get api kandidat
Route::get('/api/kandidat','KandidatController@get')->name('kandidat.get');
