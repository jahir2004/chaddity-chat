<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create($validated);
        
        MessageCreated::dispatch($message);

        return response()->json($message, 201);
    }

    public function index()
    {
        $messages = Message::all();
        return response()->json($messages);
    }

    public function delete(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
