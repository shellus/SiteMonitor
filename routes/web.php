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

Route::get('/monitor/share', 'MonitorController@share')->middleware('auth')->name('monitor.share'); // 分享页面

Route::post('/monitor/share', 'MonitorController@shareWatch')->middleware('auth')->name('monitor.Watch');

Route::post('/monitor/share-cancel', 'MonitorController@shareCancel')->middleware('auth')->name('monitor.CancelWatch');

Route::get('/monitor/watch', 'MonitorController@watchIndex')->middleware('auth')->name('monitor.myWatch');

Route::resource('/monitor', 'MonitorController')->middleware('auth');
Route::resource('/project', 'ProjectController')->middleware('auth');
Route::resource('/snapshot', 'SnapshotController')->middleware('auth');

Route::get('/test', function () {

});
