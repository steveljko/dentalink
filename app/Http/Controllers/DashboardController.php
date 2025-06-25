<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\View\View;

final class DashboardController
{
    public function __invoke(): View
    {
        $patients = Patient::all();
        $createdThisMonth = Patient::thisMonth()->count();
        $appointments = Appointment::today()->whereStatus('scheduled')->get()->load('patient');

        return view('dashboard', compact('patients', 'createdThisMonth', 'appointments'));
    }
}
