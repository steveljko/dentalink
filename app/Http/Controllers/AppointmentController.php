<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\View\View;

final class AppointmentController
{
    public function create(Patient $patient): View
    {
        return view('appointments.create', compact('patient'));
    }

    public function store(CreateAppointmentRequest $request, Patient $patient)
    {
        $patient->appointments()->create(array_merge($request->all(), ['dentist_id' => 1]));
    }

    public function show(Appointment $appointment): View
    {
        return view('appointments.show', compact('appointment'));
    }
}
