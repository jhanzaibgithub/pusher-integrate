<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
   
public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $user = auth()->user(); // get current user

    // Broadcast message
broadcast(new MessageSent($user->name, $request->message))->toOthers();

    return response()->json(['status' => 'sent']);
}

}
