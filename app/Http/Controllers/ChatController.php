<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function fetchMessages()
    {
    return Message::with('user')->orderBy('created_at')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}

