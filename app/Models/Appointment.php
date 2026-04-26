<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'time',
        'status'
    ];

    // Patient who booked the appointment
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // Doctor receiving the appointment
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    
}