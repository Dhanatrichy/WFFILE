<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\FileUploadingController@index')->name('/');
Route::resource('fileUploads', 'App\Http\Controllers\FileUploadingController');
Route::get('fileDownload/{id}', 'App\Http\Controllers\FileUploadingController@fileDownload')->name('fileDownload');