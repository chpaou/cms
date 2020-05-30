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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/** route User */

Route::namespace(
    'Admin'
)->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('actualites', 'ActualiteController');
    Route::resource('evenements', 'EvenementController');
    Route::resource('videos', 'VideoController');
    Route::resource('photoaccueils', 'PhotoaccueilController');
});
