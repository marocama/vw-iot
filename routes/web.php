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

Route::get('/', function () {
    return view('start');
});

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/statistics', 'HomeController@statistics')->name('statistics');

    Route::get ('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@upTell')->name('profile.tell');
    Route::post('/profile/password', 'ProfileController@upPass')->name('profile.pass');

    Route::get   ('/operators', 'OperatorController@show')->name('operators');
    Route::delete('/operators', 'OperatorController@del')->name('operators.del');

    Route::get ('/transmitters', 'TransmitterController@show')->name('transmitters');
    Route::get ('/transmitters/add', 'TransmitterController@form')->name('transmitters.form');
    Route::post('/transmitters/add', 'TransmitterController@add')->name('transmitters.add');

    Route::get ('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact', 'ContactController@form')->name('contact.form');

    Route::post('/monitoring', 'ReadoutController@monitoring')->name('monitoring');

    Route::get('/alerts', 'AlertController@clear')->name('alerts.clear');
});

Auth::routes(['verify' => true]);

