<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Complaint;

class MessageController extends Controller
{
    // Show messages for a complaint
    public function show($complaint_id)
    {
        $complaint = Complaint::with('user')->findOrFail($complaint_id);
        $messages = Message::where('complaint_id', $complaint_id)
                           ->orderBy('created_at', 'asc')
                           ->get();
    
        // Mark messages as read
        Message::where('complaint_id', $complaint_id)
            ->whereNull('read_at')
            ->where('user_id', '!=', auth()->id())
            ->update(['read_at' => now()]);
    
        return view('messages.show', compact('complaint', 'messages'));
    }

    // Store a new message
    public function store(Request $request, $complaint_id)
{
    $complaint = Complaint::findOrFail($complaint_id);

    // Block messaging for treated or cancelled complaints
    if ($complaint->status != 'pending') {
        return back()->with('error', 'You cannot send messages for treated or cancelled complaints.');
    }

    // Validate and save the message
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Message::create([
        'user_id' => auth()->id(),
        'complaint_id' => $complaint_id,
        'content' => $request->content,
    ]);

    return back()->with('success', 'Message sent.');
}

}

