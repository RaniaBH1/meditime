<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function recherche(Request $request)
    {
        $medecins = collect(); // liste vide par défaut

        if ($request->filled('search')) {
            $search = $request->search;
            $medecins = User::where('role', 'medecin')
                ->where('is_approved', true)
                ->where(function($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('speciality', 'like', "%$search%");
                })
                ->get();
        }

        return view('patient.recherche', compact('medecins'));
    }

    public function show($id)
    {
        $doctor = User::where('role', 'medecin')->findOrFail($id);
        return view('patient.show_doctor', compact('doctor'));
    }
}