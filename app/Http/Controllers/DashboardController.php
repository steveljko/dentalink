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
        $createdThisMonth = Patient::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $appointments = Appointment::with('patient')
            ->whereDate('scheduled_start', Carbon::today())
            ->orderBy('scheduled_start', 'desc')
            ->whereStatus('scheduled')
            ->get();

        $logs = Log::limit(5)->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('patients', 'createdThisMonth', 'appointments', 'logs'));
    }
}
