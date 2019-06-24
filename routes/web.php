<?php
Route::get('/pm', 'PmController@index');
// admin manajemen job
Route::resource('todos', 'JobController');
Route::post('todos/search', 'JobController@search')->name('todos.search');

//admin manajemen project
Route::resource('projects', 'ProjectController');
//Untuk Job tetapi menggunakan id Project
Route::get('projects/todos/{id_project}','JobController@showByProject')->name('byProject.show');
Route::get('projects/todos/create/{id_project}','JobController@createByProject')->name('byProject.create');
Route::post('projects/todos/store/{id_project}', 'JobController@storeByProject')->name('byProject.store');
Route::get('projects/todos/{id_job}/edit', 'JobController@editByProject')->name('byProject.edit');
Route::put('projects/todos/{id_job}', 'JobController@updateByProject')->name('byProject.update');
Route::delete('projects/todos/{id_job}', 'JobController@destroyByProject')->name('byProject.destroy');
// Route::post('projects/todos/store/{id}')

//admin manajemen user
Route::resource('programmers', 'UserController');
//Untuk Job tetapi menggunakan id user
Route::get('programmers/todos/{id_user}','JobController@showByUser')->name('byUser.show');
Route::get('programmers/todos/create/{id_user}','JobController@createByUser')->name('byUser.create');
Route::post('programmers/todos/store/{id_user}', 'JobController@storeByUser')->name('byUser.store');
Route::get('programmers/todos/{id_job}/edit', 'JobController@editByUser')->name('byUser.edit');
Route::put('programmers/todos/{id_job}', 'JobController@updateByUser')->name('byUser.update');
Route::delete('programmers/todos/{id_job}', 'JobController@destroyByUser')->name('byUser.destroy');

//Ganti Password
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

//route khusus programmer
Route::get('/pro', 'ProController@show');
Route::get('/pro/ambil/{id}', 'ProController@ambil');

//route bersama
Route::get('/mytodo', 'JobController@show');
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

Route::get('/profile', function(){
    return view('pm.profile');
})->name('profile');


