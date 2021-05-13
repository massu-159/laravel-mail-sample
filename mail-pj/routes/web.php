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

// 最初のルーティングをコメントアウトした
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get("/", "App\Http\Controllers\InquiryController@index")->name('index');

Route::post('inquiry', 'App\Http\Controllers\InquiryController@postInquiry')->name('inquiry');
Route::get('confirm', 'App\Http\Controllers\InquiryController@showConfirm')->name('confirm');

Route::post('confirm', 'App\Http\Controllers\InquiryController@postConfirm')->name('confirm');

Route::get('sent', 'App\Http\Controllers\InquiryController@showSentMessage')->name('sent');

Route::get('history', 'App\Http\Controllers\HistoryController@show')->name('history');

Route::get('history', 'App\Http\Controllers\HistoryController@show')->name('history')->middleware('history.basic');