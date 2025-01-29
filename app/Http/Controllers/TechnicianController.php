<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class TechnicianController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('status', 'pending')->with('user')->get(); // Load user relationship
        return view('technician.dashboard', compact('complaints'));
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        $complaint->technician_id = auth()->id(); // Assign the logged-in tech
        $complaint->save();

        return redirect()->route('technician.dashboard')->with('success', 'Complaint status updated.');
    }
}
