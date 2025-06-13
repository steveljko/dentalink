<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Log;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\View\View;

final class DashboardController
{
    public function __invoke(): View
    {
        $patients = Patient::all();
        $createdThisMonth = Patient::thisMonth()->count();
        $appointments = Appointment::today()->whereStatus('scheduled')->get();
        $logs = Log::latest()->get();

        return view('dashboard', compact('patients', 'createdThisMonth', 'appointments', 'logs'));
    }
}
