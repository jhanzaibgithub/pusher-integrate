<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\MessageSent;

Route::post('/send-message', function (Request $request) {
    $message = $request->input('message');
    $from = $request->input('from');

    broadcast(new MessageSent($message, $from))->toOthers();

    return response()->json(['status' => 'Message Sent']);
});

Route::get('/', function () {
    return view('chat');
});
Route::view('/chat-receive', 'chat-receive');
