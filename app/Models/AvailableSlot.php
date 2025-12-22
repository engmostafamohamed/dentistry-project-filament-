<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableSlot extends Model
{
    protected $fillable = [
        'date',
        'time',
        'max_bookings',
        'expected_date',
        'expected_time',
    ];
    public function isFull() : bool
    {
        return Guest::whereDate('booking_at', $this->date)
            ->whereTime('booking_at', $this->time)
            ->count() >= $this->max_bookings;
    }

    public function getExpectedDateTimeAttribute()
    {
        if ($this->expected_date && $this->expected_time) {
            return "{$this->expected_date} {$this->expected_time}";
        }
        return null;
    }
}
