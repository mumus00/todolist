<?php
// admin manajemen job
Route::get('/pm', 'PmController@index');
Route::get('/todo/tambah', 'PmController@tambah');
Route::post('/todo/add', 'PmController@add');
Route::get('/todo/edit/{id}', 'PmController@edit');
Route::put('/todo/edit/update/{id}', 'PmController@update');
Route::delete('/todo/delete/{id}', 'PmController@delete');

//admin manajemen project
Route::get('/project', 'PmController@showProject');
Route::get('/project/tambah', 'PmController@tambahProject');
Route::post('/project/add', 'PmController@addProject');
Route::get('/project/edit/{id}', 'PmController@editProject');
Route::put('/project/edit/update/{id}', 'PmController@updateProject');
Route::delete('/project/delete/{id}', 'PmController@deleteProject');

//admin manajemen user
Route::get('/programmer', 'PmController@showProgrammer');
Route::get('/programmer/tambah', 'PmController@tambahProgrammer');
Route::post('/programmer/add', 'PmController@addProgrammer');
Route::get('/programmer/edit/{id}', 'PmController@editProgrammer');
Route::put('/programmer/edit/update/{id}', 'PmController@updateProgrammer');
Route::delete('/programmer/delete/{id}', 'PmController@deleteProgrammer');

//admin manajemen tugas setiap project
Route::get('/detail/{id_project}', 'PmController@showDetail');
Route::get('/detail/tambah/{id_project}', 'PmController@tambahDetail');
Route::post('/detail/add/{id}', 'PmController@addDetail');
Route::get('/detail/edit/{id_job}', 'PmController@editDetail');
Route::put('/detail/edit/update/{id_project}', 'PmController@updateDetail');
Route::delete('/detail/delete/{id}', 'PmController@deleteDetail');

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

//route khusu programmer
Route::get('/pro', 'ProController@show');
Route::get('/pro/ambil/{id}', 'ProController@ambil');

//route bersama
Route::get('/mytodo', 'HomeController@mytodo');
Route::get('/selesai/{id_job}', 'HomeController@selesai');
Route::post('/search', 'HomeController@search');
Route::get('/search/{username}','HomeController@searchUser');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function(){
	return redirect('/home');
});

Route::get('/register', function(){
	return redirect('/');
});

Route::get('/login2', function(){
    return view('auth.login2');
});

Route::get('/profile', function(){
    return view('pm.profile');
})->name('profile');


