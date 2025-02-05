<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\TechnicianController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Str;
use App\Models\Complaint;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
    return view('dashboard', compact('complaints'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/technician/dashboard', [TechnicianController::class, 'index'])->name('technician.dashboard')->middleware('tech');
});
Route::get('admin/logout', function (Request $request) {
    // Perform the logout
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect anywhere, e.g. homepage
    return redirect('/');
})->name('backpack.logout');
Route::middleware(['auth', 'tech'])->group(function () {
    Route::put('/technician/update-status/{id}', [TechnicianController::class, 'updateStatus'])->name('technician.updateStatus');
    Route::put('/technician/updateStatus/{id}', [TechnicianController::class, 'updateStatus'])->name('technician.updateStatus');
});
require __DIR__.'/auth.php';
