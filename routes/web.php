<?php

use App\Http\Controllers\OrderController;
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
Route::get('/', function(){ return redirect()->route('order.index'); });

Route::resource('/order', OrderController::class)->only(['index', 'show', 'destroy']);
Route::get('/fetch', function(){
    \App\Jobs\OrderEmailFetcher::dispatchSync();
    return redirect()->route('order.index');
});
