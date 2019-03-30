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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/','AdminController@index');
    Route::get('/dashboard','AdminController@index');

    Route::resource('email-template', 'EmailTemplateController')->except(['create']);
});


// Route::view('/', 'home');
// Route::view('/{any}', 'home');
// Route::view('/{any}/{param}', 'home');