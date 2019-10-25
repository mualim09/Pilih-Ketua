<?php


// ------------ ROUTE WEBSITE ADMIN ------------------------ //


// view login
Route::get('/admin/login', 'AdminController@login')->name('login')->middleware('guest');
// home admin
Route::get('/admin','AdminController@index')->name('admin.home')->middleware('auth');
// fungsi autentikasi admin
Route::post('/admin/auth', 'AdminController@auth')->name('admin.auth')->middleware('guest');
// logout admin
Route::get('/admin/logout','AdminController@logout')->name('admin.logout')->middleware('auth');

// fungsi register
Route::post('/admin/manage_admin/add','AdminController@register_action')->name('admin.postRegister')->middleware('auth');
// manajemen admin
Route::get('/admin/manage_admin','AdminController@manageAdmin')->name('admin.manageAdmin')->middleware('auth');
// hapus admin
Route::get('/admin/manage_admin/delete/{id}','AdminController@deleteAdmin')->name('admin.account.delete')->middleware('auth');
// edit admin
Route::put('/admin/manage_admin/edit/{id}','AdminController@editAdmin')->name('admin.account.edit')->middleware('auth');
// view hasil pemilihan versi teks
Route::get('/admin/hasilText','AdminController@hasilText')->name('admin.hasil.text')->middleware('auth');
// view hasil pemilihan versi grafik
Route::get('/admin/hasilGrafik','AdminController@hasilGrafik')->name('admin.hasil.grafik')->middleware('auth');
//hapus hasil
Route::get('/admin/hasil/delete/{id}','AdminController@deleteHasil')->name('admin.hasil.delete')->middleware('auth');




// nonaktifkan pemilihan
Route::post('/api/off','UserController@off')->name('pemilihan.off');
// aktifkan pemilihan
Route::post('/api/on','UserController@on')->name('pemilihan.on');
// suara terbanyak
Route::get('/api/suaraTerbanyak','AdminController@suaraTerbanyak')->name('suaraTerbanyak');




// ---------- ROUTE KANDIDAT --------------- //

// manajemen kandidat
Route::get('/admin/manage_kandidat','KandidatController@manageKandidat')->name('admin.manageKandidat')->middleware('auth');
// tambah kandidat
Route::post('/admin/manage_kandidat/add','KandidatController@register_action')->name('kandidat.postRegister')->middleware('auth');
// hapus kandidat
Route::get('/admin/manage_kandidat/delete/{id}','KandidatController@deleteKandidat')->name('kandidat.account.delete')->middleware('auth');
// edit kandidat
Route::put('/admin/manage_kandidat/edit/{id}','KandidatController@editKandidat')->name('kandidat.account.edit')->middleware('auth');
Route::get('/api/suara','AdminController@getSuara')->name('kandidat.suara');
Route::get('/api/persenSuara','AdminController@persenSuara')->name('kandidat.persenSuara');

