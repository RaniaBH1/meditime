<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;

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

    Route::get('/admin/medecins-en-attente', [AdminController::class, 'pendingDoctors'])
        ->name('admin.medecins.pending');

    Route::post('/admin/medecins/{id}/approve', [AdminController::class, 'approveDoctor'])
        ->name('admin.medecins.approve');
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
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])
    ->name('profile.photo.destroy');
});

use App\Http\Controllers\AppointmentController;

Route::post('/appointments', [AppointmentController::class, 'store'])
    ->name('appointments.store')
    ->middleware('auth');

Route::get('/medecin/{id}', [MedecinController::class, 'show'])
    ->name('medecin.show');
    
Route::get('/doctor/appointments', [AppointmentController::class, 'doctorAppointments'])
    ->name('doctor.appointments')
    ->middleware('auth');

Route::patch('/appointments/{id}/confirm', [AppointmentController::class, 'confirm'])
    ->name('appointments.confirm');

Route::patch('/appointments/{id}/reject', [AppointmentController::class, 'reject'])
    ->name('appointments.reject');  

Route::get('/search-medecins', [PatientController::class, 'recherche'])
    ->name('medecin.search');

Route::get('/patient/appointments',[AppointmentController::class,'patientAppointments'])
    ->name('patient.appointments');  
    
use App\Http\Controllers\DoctorAvailabilityController;
Route::middleware(['auth','role:medecin'])->group(function () {

Route::get('/medecin/disponibilites',
    [DoctorAvailabilityController::class,'index'])
    ->name('medecin.disponibilites');

Route::post('/medecin/disponibilites',
    [DoctorAvailabilityController::class,'store'])
    ->name('medecin.disponibilites.store');

Route::delete('/medecin/disponibilites/{id}',
    [DoctorAvailabilityController::class,'destroy'])
    ->name('medecin.disponibilites.delete');

});

Route::get('/medecin/{id}', [MedecinController::class, 'show'])
    ->whereNumber('id')
    ->name('medecin.show');

Route::get('/doctor/{id}/available-slots',[AppointmentController::class,'availableSlots']);

Route::get('/doctor/calendar/{date}',
    [AppointmentController::class,'doctorCalendar'])
    ->middleware('auth');

Route::get('/medecin/dashboard',[MedecinController::class,'dashboard'])
->middleware(['auth','role:medecin'])
->name('medecin.dashboard');

Route::get('/doctor/calendar',
[AppointmentController::class,'doctorCalendar'])
->name('doctor.calendar');

Route::post('/notifications/read', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

require __DIR__.'/auth.php';