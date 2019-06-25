<?php
// manajemen job
Route::resource('todos', 'JobController');
Route::post('todos/search', 'JobController@search')->name('todos.search');
Route::get('todos/ambil/{id}', 'JobController@ambil')->name('todos.ambil');
Route::get('mytodo/{id}','JobController@show')->name('todos.mytodo');
Route::get('done/{id}','JobController@done');

//manajemen project
Route::resource('projects', 'ProjectController');
Route::get('projects/todos/{id_project}','JobController@showByProject')->name('byProject.show');
Route::get('projects/todos/create/{id_project}','JobController@createByProject')->name('byProject.create');
Route::post('projects/todos/store/{id_project}', 'JobController@storeByProject')->name('byProject.store');
Route::get('projects/todos/{id_job}/edit', 'JobController@editByProject')->name('byProject.edit');
Route::put('projects/todos/{id_job}', 'JobController@updateByProject')->name('byProject.update');
Route::delete('projects/todos/{id_job}', 'JobController@destroyByProject')->name('byProject.destroy');

//manajemen user
Route::resource('programmers', 'UserController');
Route::get('programmers/todos/{id_user}','JobController@showByUser')->name('byUser.show');
Route::get('programmers/todos/create/{id_user}','JobController@createByUser')->name('byUser.create');
Route::post('programmers/todos/store/{id_user}', 'JobController@storeByUser')->name('byUser.store');
Route::get('programmers/todos/{id_job}/edit', 'JobController@editByUser')->name('byUser.edit');
Route::put('programmers/todos/{id_job}', 'JobController@updateByUser')->name('byUser.update');
Route::delete('programmers/todos/{id_job}', 'JobController@destroyByUser')->name('byUser.destroy');
Route::get('/changePassword','UserController@editPassword')->name('user.editPass');
Route::post('/changePassword','UserController@updatePassword')->name('user.updatePass');

Auth::routes();
Route::get('/home', 'JobController@index')->name('home');
Route::get('/', function(){
	return redirect('/home');
});
Route::get('/register', function(){
	return redirect('/');
});
