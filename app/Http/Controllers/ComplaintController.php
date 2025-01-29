<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Show the complaint submission form.
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Store a newly submitted complaint.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
        'phone' => 'required|string|max:8',
        'address' => 'required|string|max:500',
    ]);

    Complaint::create([
        'user_id' => auth()->id(),
        'subject' => $validated['subject'],
        'description' => $validated['description'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Your complaint has been submitted.');
}

}

