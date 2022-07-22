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
Route::post('/order-reply/{id}', [OrderController::class, 'sendReply'])->name('order.reply');
//Route::get('/order-html/{id}', [\App\Http\Controllers\HtmlEmailContentController::class, 'renderOrder'])->name('order.html');

Route::get('/order-reply-preview/{id}', function($id){
    return new \App\Mail\OrderReply(\App\Models\OrderReply::findOrFail($id));
})->name('order.reply.preview');

// Routes for development purposes only
if (env('APP_ENV', 'local') === 'local') {
    Route::get('/fetch', function(){
        \App\Jobs\OrderEmailFetcher::dispatchSync();
        return redirect()->route('order.index');
    });
}

