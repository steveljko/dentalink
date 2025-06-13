<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\View\View;

final class ShowAppointmentsController
{
    public function __invoke(): View
    {
        $appointments = Appointment::all()->load('patient');
        $todayAppointmentsCount = Appointment::today()->count();
        $thisYearAppointmentsCount = Appointment::thisYear()->count();

        return view('appointments.index', compact(
            'appointments',
            'todayAppointmentsCount',
            'thisYearAppointmentsCount',
        ));
    }
}
