<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\DoctorAvailabilitySlot;
use App\Notifications\AppointmentConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentRejected;

class AppointmentController extends Controller
{

/**
 * Store appointment created by patient
 */
public function store(Request $request)
{
    $request->validate([
        'doctor_id'=>'required|exists:users,id',
        'date'=>'required|date',
        'time'=>'required'
    ]);

    Appointment::create([
        'patient_id'=>Auth::id(),
        'doctor_id'=>$request->doctor_id,
        'date'=>$request->date,
        'time'=>$request->time,
        'status'=>'pending'
    ]);

    return response()->json([
        'success'=>true
    ]);
}


/**
 * Doctor appointments list
 */
public function doctorAppointments()
{
    $appointments = Appointment::where('doctor_id',Auth::id())
        ->with('patient')
        ->orderBy('date')
        ->get();

    return view('medecin.appointments',compact('appointments'));
}


/**
 * Patient appointments
 */
public function patientAppointments()
{
    $appointments = Appointment::where('patient_id',Auth::id())
        ->with('doctor')
        ->orderBy('date')
        ->get();

    return view('patient.appointments',compact('appointments'));
}


/**
 * Confirm appointment
 */
public function confirm($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'status' => 'confirmed'
    ]);

    $patient = User::find($appointment->patient_id);

    if($patient){
        $patient->notify(new AppointmentConfirmed($appointment));
    }

    return back()->with('success','Rendez-vous confirmé');
}


/**
 * Reject appointment
 */
public function reject($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'status' => 'rejected'
    ]);

    $patient = User::find($appointment->patient_id);

    if ($patient) {
        $patient->notify(new AppointmentRejected($appointment));
    }

    return back()->with('success','Rendez-vous refusé');
}


/**
 * Generate available slots
 */
public function availableSlots($id, Request $request)
{
    $date = $request->date;

    $slots = $this->getAvailableSlots($id, $date);

    return response()->json($slots);
}

public function getAvailableSlots($doctorId, $date)
{

    // Convert date to weekday (monday, tuesday, etc.)
    $dayOfWeek = strtolower(date('l', strtotime($date)));

    $availability = DoctorAvailabilitySlot::where('doctor_id', $doctorId)
        ->where('day_of_week', $dayOfWeek)
        ->get();

    $slots = [];

    foreach ($availability as $slot) {

        $start = strtotime($slot->start_time);
        $end = strtotime($slot->end_time);

        while ($start < $end) {

            $slots[] = date("H:i", $start);

            $start = strtotime("+1 hour", $start);
        }
    }

    // Remove already booked slots
    $booked = Appointment::where('doctor_id', $doctorId)
        ->whereDate('date', $date)
        ->pluck('time')
        ->toArray();

    return array_values(array_diff($slots, $booked));
}

/**
 * Doctor calendar page
 */
public function doctorCalendar()
{
    $doctor = auth()->user();

    $appointments = Appointment::where('doctor_id',$doctor->id)
        ->with('patient')
        ->get();

    return view('medecin.calendar',[
        'doctorMode'=>true,
        'appointments'=>$appointments,
        'medecin'=>$doctor
    ]);
}

}