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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/upload', 'HomeController@upload')->name('home.upload');
Route::post('/home/upload', 'HomeController@processUpload')->name('home.processUpload');

Route::get('/home/reports', 'HomeController@reports')->name('home.reports');
Route::get('/home/download', 'HomeController@download')->name('home.download');
Route::get('/home/workProgress', 'HomeController@workProgress')->name('home.workProgress');

Auth::routes();

