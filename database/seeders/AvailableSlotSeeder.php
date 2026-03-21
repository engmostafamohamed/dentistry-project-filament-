<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AvailableSlot;

class AvailableSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule = [
            // Working days (Sunday → Thursday)
            ['day_name' => 'Sunday',    'day_of_week' => 7, 'opening_time' => '08:00:00', 'closing_time' => '18:00:00', 'type' => 'normal', 'is_active' => true, 'note' => 'Working day'],
            ['day_name' => 'Monday',    'day_of_week' => 1, 'opening_time' => '08:00:00', 'closing_time' => '18:00:00', 'type' => 'normal', 'is_active' => true, 'note' => 'Working day'],
            ['day_name' => 'Tuesday',   'day_of_week' => 2, 'opening_time' => '08:00:00', 'closing_time' => '18:00:00', 'type' => 'normal', 'is_active' => true, 'note' => 'Working day'],
            ['day_name' => 'Wednesday', 'day_of_week' => 3, 'opening_time' => '08:00:00', 'closing_time' => '18:00:00', 'type' => 'normal', 'is_active' => true, 'note' => 'Working day'],
            ['day_name' => 'Thursday',  'day_of_week' => 4, 'opening_time' => '08:00:00', 'closing_time' => '18:00:00', 'type' => 'normal', 'is_active' => true, 'note' => 'Working day'],
            // Off days
            ['day_name' => 'Friday',    'day_of_week' => 5, 'type' => 'off', 'is_active' => false, 'note' => 'Weekly off day'],
            ['day_name' => 'Saturday',  'day_of_week' => 6, 'type' => 'off', 'is_active' => false, 'note' => 'Weekly off day'],
        ];

        foreach ($schedule as $slot) {
            AvailableSlot::create([
                'day_name' => $slot['day_name'],
                'day_of_week' => $slot['day_of_week'],
                'opening_time' => $slot['opening_time'] ?? null,
                'closing_time' => $slot['closing_time'] ?? null,
                'max_bookings' => 3,
                'current_bookings' => 0,
                'type' => $slot['type'],
                'is_active' => $slot['is_active'],
                'is_blocked' => false,
                'note' => $slot['note'] ?? null,
            ]);
        }

        echo "Weekly slot pattern seeded (7 records)\n";
    }
}
