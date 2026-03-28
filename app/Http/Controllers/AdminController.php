<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $pendingDoctorsCount = User::where('role', 'medecin')
            ->where('is_approved', false)
            ->count();

        return view('admin.dashboard', compact('pendingDoctorsCount'));
    }

    public function pendingDoctors(): View
    {
        $pendingDoctors = User::where('role', 'medecin')
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('admin.pending-doctors', compact('pendingDoctors'));
    }

    public function approveDoctor(int $id): RedirectResponse
    {
        $doctor = User::where('role', 'medecin')->findOrFail($id);

        $doctor->update([
            'is_approved' => true,
        ]);

        return redirect()->route('admin.medecins.pending')
            ->with('success', 'Le médecin a été validé avec succès.');
    }
}