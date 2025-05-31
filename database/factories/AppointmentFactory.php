<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appoitment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::all()->random(),
            'dentist_id' => User::find(1),
            'scheduled_start' => Carbon::today(),
            'duration' => fake()->numberBetween(30, 60),
            'status' => fake()->randomElement(['scheduled', 'confirmed', 'completed', 'cancelled', 'no_show']),
            'notes' => fake()->text(),
            'estimated_cost' => fake()->numberBetween(1000, 30000),
            'actual_cost' => fake()->numberBetween(1000, 30000),
            'payment_status' => fake()->randomElement(['pending', 'paid', 'partially_paid']),
        ];
    }
}
