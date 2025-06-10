<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\View\View;

final class ShowAppointmentsController
{
    public function __invoke(): View
    {
        $appointments = Appointment::all()->load('patient');

        $todayAppointmentsCount = Appointment::whereDate('scheduled_start', Carbon::today())
            ->whereStatus('scheduled')
            ->count();

        $thisYearAppointmentsCount = Appointment::whereYear('created_at', Carbon::now()->year)->count();

        return view('appointments.index', compact('appointments', 'todayAppointmentsCount', 'thisYearAppointmentsCount'));
    }
}
