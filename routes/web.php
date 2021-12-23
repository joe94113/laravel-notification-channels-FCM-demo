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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 測試通知push
Route::get('/push', [App\Http\Controllers\PushController::class, 'push'])->name('push')->middleware('auth');
// 取得fcm token
Route::post('/fcm-token', [App\Http\Controllers\PushController::class, 'fcmToken'])->name('fcm.token')->middleware('auth');
