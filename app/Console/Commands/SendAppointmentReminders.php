<?php

namespace App\Console\Commands;

use App\Enums\NotificationChannel;
use App\Enums\NotificationLevel;
use App\Events\NewNotification;
use App\Models\Appointment;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-appointment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appointment reminder in notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = Appointment::whereBetween('scheduled_start', [
            Carbon::now()->addMinutes(15),
            Carbon::now()->addMinute(16),
        ])->get();

        foreach ($appointments as $appointment) {
            broadcast(new NewNotification(1));

            $n = Notification::create([
                'level' => NotificationLevel::INFO,
                'channel' => NotificationChannel::APPOINTMENT,
                'message' => 'You have appointment 15 minuts',
                'additional' => json_encode([
                    'patient_id' => $appointment->patient_id,
                ]),
                'is_sent' => true,
            ]);

        }
    }
}
