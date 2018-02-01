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

Route::resource('/monitor', 'MonitorController')->middleware('auth');
Route::resource('/project', 'ProjectController')->middleware('auth');
Route::resource('/snapshot', 'SnapshotController')->middleware('auth');

Route::get('/test', function () {

});
