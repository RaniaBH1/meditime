<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->q);

        if (!$query) {
            return response()->json([]);
        }

        // Utilisez 'speciality' (avec 'i') comme dans votre base
        $medecins = User::where('role', 'medecin')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('speciality', 'like', "%{$query}%");
            })
            ->select('id', 'name', 'speciality', 'address', 'phone', 'photo')
            ->get();

        return response()->json($medecins);
    }

    public function show($id)
    {
        $medecin = User::where('role', 'medecin')
            ->where('id', $id)
            ->firstOrFail();

        return view('medecin.calendar', compact('medecin'));
    }

    public function dashboard()
{
    $doctorId = auth()->id();

    $appointmentsCount = \App\Models\Appointment::where('doctor_id',$doctorId)->count();

    $pendingCount = \App\Models\Appointment::where('doctor_id',$doctorId)
        ->where('status','pending')
        ->count();

    $availabilityCount = \App\Models\DoctorAvailabilitySlot::where('doctor_id',$doctorId)
        ->count();

    $todayAppointments = \App\Models\Appointment::where('doctor_id',$doctorId)
        ->whereDate('date', now())
        ->with('patient')
        ->orderBy('time')
        ->get();

    return view('medecin.dashboard',[
        'appointmentsCount'=>$appointmentsCount,
        'pendingCount'=>$pendingCount,
        'availabilityCount'=>$availabilityCount,
        'todayAppointments'=>$todayAppointments
    ]);
}
}