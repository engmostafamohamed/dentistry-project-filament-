<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Offer;
use App\Models\AvailableSlot;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::with(['regions.branches'])->get();
        $offers = Offer::all();

        // Weekly working days (recurring pattern)
        $workingDays = AvailableSlot::where('type', 'normal')
            ->whereNull('date')
            ->where('is_active', true)
            ->pluck('day_of_week')
            ->toArray();

        // Specific "extra working" dates (e.g., Friday that’s normally off)
        $extraWorkingDates = AvailableSlot::whereNotNull('date')
            ->where('type', 'normal')
            ->where('is_active', true)
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        // Specific "holiday" or off dates (e.g., special closure)
        $holidayDates = AvailableSlot::whereNotNull('date')
            ->whereIn('type', ['off', 'holiday'])
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        return view('website.index', compact('countries', 'offers', 'workingDays', 'extraWorkingDates', 'holidayDates'));
    }

    public function getAvailableTimes(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $date = Carbon::parse($request->date);
        $today = Carbon::today();
        $maxDate = Carbon::today()->addDays(30);

        if ($date->lt($today) || $date->gt($maxDate)) {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        // Step Check if this date has a specific override record
        $slot = AvailableSlot::whereDate('date', $date)
            ->where('is_active', true)
            ->first();

        // Step If no date-specific record, use weekly pattern
        if (!$slot) {
            $dayOfWeek = $date->dayOfWeekIso; // 1=Mon ... 7=Sun
            $slot = AvailableSlot::whereNull('date')
                ->where('day_of_week', $dayOfWeek)
                ->where('type', 'normal')
                ->where('is_active', true)
                ->first();
        }

        // Step If no active slot found at all
        if (!$slot) {
            return response()->json(['times' => []]);
        }

        $opening = Carbon::parse($slot->opening_time);
        $closing = Carbon::parse($slot->closing_time);
        $hours = [];

        while ($opening->lt($closing)) {
            $time = $opening->format('H:i');

            // Check booked count for this specific date+time
            $bookedCount = \App\Models\Guest::whereDate('booking_at', $date)
                ->whereTime('booking_at', $time)
                ->count();

            $isFull = $bookedCount >= $slot->max_bookings;

            $hours[] = [
                'time' => $time,
                'disabled' => $isFull,
            ];

            $opening->addHour();
        }

        return response()->json(['times' => $hours]);
    }


}
