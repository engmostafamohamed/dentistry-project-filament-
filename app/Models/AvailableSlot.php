<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AvailableSlot extends Model
{
    protected $fillable = [
        'doctor_id',
        'day_name',
        'day_of_week',
        'date',
        'opening_time',
        'closing_time',
        'time',
        'max_bookings',
        'current_bookings',
        'type',
        'is_active',
        'is_blocked',
        'note',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    protected $casts = [
        'date' => 'date',
        'opening_time' => 'datetime:H:i:s',
        'closing_time' => 'datetime:H:i:s',
        'time' => 'datetime:H:i:s',
        'is_active' => 'boolean',
        'is_blocked' => 'boolean',
    ];
    public function isFull() : bool
    {
        return Guest::whereDate('booking_at', $this->date)
            ->whereTime('booking_at', $this->time)
            ->count() >= $this->max_bookings;

        // return $this->current_bookings >= $this->max_bookings;
    }
    public function getExpectedDateTimeAttribute()
    {
        if ($this->expected_date && $this->expected_time) {
            return "{$this->expected_date} {$this->expected_time}";
        }
        return null;
    }
    // Get all available days within next X days
    public static function getAvailableDays($daysCount = 30)
    {
        $start = Carbon::today();
        $end = Carbon::today()->addDays($daysCount);

        $availableDays = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {

            // get slots for this day
            $slots = self::where('date', $date->toDateString())
                ->where('is_active', true)
                ->where('type', 'normal')
                ->get();

            // if no slots OR all slots are full/off/holiday => disabled
            $disabled = $slots->isEmpty() || $slots->every(fn($slot) => $slot->isFull());

            $availableDays[] = [
                'date' => $date->toDateString(),
                'day_name' => $date->format('l'),
                'disabled' => $disabled,
            ];
        }

        return $availableDays;
    }

    // Get available hours for a specific date
    public static function getAvailableSlots($date)
    {
        $slots = self::where('date', $date)
            ->where('is_active', true)
            ->where('type', 'normal')
            ->get();

        $available = [];

        foreach ($slots as $slot) {
            if (!$slot->isFull() && !$slot->is_blocked) {
                $available[] = $slot->time->format('H:i');
            }
        }

        return $available;
    }
}
