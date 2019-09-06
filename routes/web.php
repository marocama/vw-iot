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
Route::get('/login/{linkName}', 'Auth\LoginController@loginCustom')->name('loginCustom');

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/','HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/statistics', 'HomeController@statistics')->name('statistics');

    Route::get ('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@upTell')->name('profile.tell');
    Route::get ('/profile/password', function() { return redirect('profile'); });
    Route::post('/profile/password', 'ProfileController@upPass')->name('profile.pass');

    Route::get   ('/profile/logo', function() { return redirect('profile'); });
    Route::post  ('/profile/logo', 'ProfileController@logoUpdate')->name('profile.logo');
    Route::delete('/profile/logo', 'ProfileController@logoDelete')->name('profile.logoDel');
    Route::get   ('/profile/link', function() { return redirect('profile'); });
    Route::post  ('/profile/link', 'ProfileController@linkUpdate')->name('profile.link');

    Route::get   ('/operators', 'OperatorController@show')->name('operators');
    Route::delete('/operators', 'OperatorController@del')->name('operators.del');

    Route::get ('/transmitters', 'TransmitterController@show')->name('transmitters');
    Route::get ('/transmitters/add', 'TransmitterController@form')->name('transmitters.form');
    Route::post('/transmitters/add', 'TransmitterController@add')->name('transmitters.add');

    Route::get ('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact', 'ContactController@form')->name('contact.form');

    Route::get ('/monitoring', function() { return redirect('/'); });
    Route::post('/monitoring', 'ReadoutController@monitoring')->name('monitoring');
    Route::get ('/monitoring/mask', function() { return redirect('/'); });
    Route::post('/monitoring/mask', 'ReadoutController@setMask')->name('monitoring.mask');

    Route::get ('/mask/new', function() { return redirect('/'); });
    Route::post('/mask/new', 'ReadoutController@newMark')->name('mark.new');

    Route::get('/alerts', 'AlertController@clear')->name('alerts.clear');

    // *** Rotas Administrativas **************************************** 

    Route::get ('/query', function() { return redirect('/'); });
    Route::post('/query', 'AdminController@query')->name('admin.query');

    Route::get   ('/warning', 'AdminController@alert')->name('admin.alert');
    Route::post  ('/warning', 'AdminController@registerAlert')->name('admin.register');
    Route::delete('/warning', 'AdminController@deleteAlert')->name('admin.alert.del');

    Route::get ('/expirations', 'AdminController@expirations')->name('admin.expirations');

    Route::get ('/suport', 'AdminController@suport')->name('admin.suport');
    Route::post('/suport', 'AdminController@answered')->name('admin.answered');

    Route::get   ('/delUser', function() { return redirect('/'); });
    Route::delete('/delUser', 'AdminController@userDel')->name('admin.user.del');
    
    Route::get   ('/delTran', function() { return redirect('/'); });
    Route::delete('/delTran', 'AdminController@transmitterDel')->name('admin.transmitter.del');

    Route::get  ('/user', function() { return redirect('/'); });
    Route::post ('/user', 'AdminController@userView')->name('admin.user.view');

    Route::get  ('/user/save', function() { return redirect('/'); });
    Route::post ('/user/save', 'AdminController@userEdit')->name('admin.user.edit');

    Route::get  ('/transmitter', function() { return redirect('/'); });
    Route::post ('/transmitter', 'AdminController@tranView')->name('admin.tran.view');

    Route::get  ('/transmitter/save', function() { return redirect('/'); });
    Route::post ('/transmitter/save', 'AdminController@tranEdit')->name('admin.tran.edit');

    Route::get ('/transmitter/new', 'AdminController@tranNew')->name('admin.tran.new');
    Route::post ('/transmitter/new', 'AdminController@tranSave')->name('admin.tran.save');

    Route::get ('/interfaces', 'AdminController@interaction')->name('admin.interaction');
    Route::post('/interfaces', 'AdminController@registerInteraction')->name('admin.interaction.register');

    Route::get   ('/data', 'AdminController@data')->name('admin.data');
    Route::delete('/data', 'AdminController@deleteData')->name('admin.data.delete');
});

Auth::routes(['verify' => true]);

