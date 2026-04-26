<?php

namespace App\Http\Controllers;

use App\Models\DoctorAvailabilitySlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoctorAvailabilityController extends Controller
{
    public function index()
    {
        $slots = DoctorAvailabilitySlot::where('doctor_id', Auth::id())->get();

        return view('medecin.disponibilites', compact('slots'));
    }

    public function store(Request $request)
{
    $request->validate([
        'day_of_week' => 'required',
        'start_time' => 'required|array',
        'end_time' => 'required|array'
    ]);

    foreach ($request->start_time as $index => $start) {

        DoctorAvailabilitySlot::create([
            'doctor_id' => Auth::id(),
            'day_of_week' => $request->day_of_week,
            'start_time' => $start,
            'end_time' => $request->end_time[$index]
        ]);

    }

    return back()->with('success','Créneaux ajoutés');
}

    public function destroy($id)
    {
        DoctorAvailabilitySlot::findOrFail($id)->delete();

        return back();
    }
}