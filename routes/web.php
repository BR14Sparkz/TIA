<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'ArticlesController@welcome');

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile/{username}', 'ProfileController@profile');

Route::resource('articles', 'ArticlesController');

//Route::put('articles/async.php', App\async.php);


