<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{

public function recherche(Request $request)
{
    $medecins = collect();

    if ($request->filled('q')) {

        $search = $request->q;

        $medecins = User::where('role', 'medecin')
            ->where('is_approved', true)
            ->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('speciality', 'like', "%$search%");
            })
            ->get();
    }

    if ($request->ajax()) {
        return response()->json($medecins);
    }

    $unreadNotifications = auth()->user()->unreadNotifications()->count();

    return view('patient.recherche', compact('medecins','unreadNotifications'));
}


public function show($id)
{
    $doctor = User::where('role','medecin')->findOrFail($id);

    $unreadNotifications = auth()->user()->unreadNotifications()->count();

    return view('patient.show_doctor', compact('doctor','unreadNotifications'));
}
public function dashboard()
{
    $unreadNotifications = auth()->user()->unreadNotifications()->count();

    return view('patient.dashboard', [
        'unreadNotifications' => $unreadNotifications
    ]);
}

}