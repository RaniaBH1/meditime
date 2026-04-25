<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedecinController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/contact', function (){
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if ($user->role === 'medecin') {
        return redirect()->route('medecin.dashboard');
    }
    return redirect()->route('patient.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/medecins-en-attente', [AdminController::class, 'pendingDoctors'])->name('admin.medecins.pending');
    Route::post('/admin/medecins/{id}/approve', [AdminController::class, 'approveDoctor'])->name('admin.medecins.approve');
});

Route::middleware(['auth', 'role:medecin'])->group(function () {
    Route::get('/medecin/dashboard', function () {
        return view('medecin.dashboard');
    })->name('medecin.dashboard');
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');
    Route::get('/patient/recherche', [PatientController::class, 'recherche'])->name('patient.recherche');
    Route::get('/patient/doctor/{id}', [PatientController::class, 'show'])->name('doctor.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ROUTE POUR SUPPRIMER LA PHOTO
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    
    Route::get('/medecin/{id}', [MedecinController::class, 'show'])->name('medecin.show');
    Route::get('/search-medecins', [MedecinController::class, 'search'])->name('medecin.search');
});

require __DIR__.'/auth.php';