<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AvailableSlot;
class AvailableSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            foreach (range(10, 20) as $hour) {
                AvailableSlot::create([
                    'date' => $date->toDateString(),
                    'time' => sprintf('%02d:00:00', $hour),
                    'max_bookings' => 3,
                    'expected_date' => null,
                    'expected_time' => null,
                ]);
            }
        }
        // Example of a slot with an expected follow-up
        AvailableSlot::create([
            'date'          => Carbon::today()->addDays(3)->toDateString(),
            'time'          => '12:00',
            'max_bookings'  => 5,
            'expected_date' => Carbon::today()->addDays(10)->toDateString(),
            'expected_time' => '12:30',
        ]);
    }
}
