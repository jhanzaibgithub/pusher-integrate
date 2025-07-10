<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/chat-receive', [HomeController::class, 'chatReceiver']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);

});


