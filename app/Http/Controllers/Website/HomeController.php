<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Offer;
use App\Models\AvailableSlot;
use App\Models\Guest;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::with(['regions.branches'])->get();

        $offers = Offer::all()->map(function ($offer) {
            $title       = (array) ($offer->title ?? []);
            $description = (array) ($offer->description ?? []);
            $isExpired   = $offer->expires_at && Carbon::parse($offer->expires_at)->isPast();

            return [
                'id'             => $offer->id,
                'title_en'       => $title['en'] ?? '',
                'title_ar'       => $title['ar'] ?? $title['en'] ?? '',
                'description_en' => $description['en'] ?? '',
                'description_ar' => $description['ar'] ?? $description['en'] ?? '',
                'image_url'      => $offer->image ? asset('storage/' . $offer->image) : null,
                'is_active'      => $offer->is_active,
                'expires_at'     => $offer->expires_at ? Carbon::parse($offer->expires_at)->toDateTimeString() : null,
                'discount'       => $offer->discount,
                'is_expired'     => $isExpired,
            ];
        })->filter(fn($o) => !$o['is_expired'] && $o['is_active'])->values();

        $workingDays = AvailableSlot::where('type', 'normal')
            ->whereNull('date')
            ->where('is_active', true)
            ->pluck('day_of_week')
            ->toArray();

        $extraWorkingDates = AvailableSlot::whereNotNull('date')
            ->where('type', 'normal')
            ->where('is_active', true)
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        $holidayDates = AvailableSlot::whereNotNull('date')
            ->whereIn('type', ['off', 'holiday'])
            ->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        return view('website.index', compact(
            'countries', 'offers', 'workingDays', 'extraWorkingDates', 'holidayDates'
        ));
    }

    public function getAvailableTimes(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $date    = Carbon::parse($request->date);
        $today   = Carbon::today();
        $maxDate = Carbon::today()->addDays(30);

        if ($date->lt($today) || $date->gt($maxDate)) {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        // Correct: whereDate('column', $value) — two arguments required
        $slot = AvailableSlot::whereDate('date', $date->toDateString())
            ->where('is_active', true)
            ->first();

        if (!$slot) {
            $dayOfWeek = $date->dayOfWeekIso; // 1=Mon ... 7=Sun
            $slot = AvailableSlot::whereNull('date')
                ->where('day_of_week', $dayOfWeek)
                ->where('type', 'normal')
                ->where('is_active', true)
                ->first();
        }

        if (!$slot) {
            return response()->json(['times' => []]);
        }

        $opening = Carbon::parse($slot->opening_time);
        $closing = Carbon::parse($slot->closing_time);
        $hours   = [];

        while ($opening->lt($closing)) {
            $time = $opening->format('H:i');

            // ✅ Correct: whereDate('column', $value) — two arguments
            $bookedCount = Guest::whereDate('booking_at', $date->toDateString())
                ->whereTime('booking_at', $time)
                ->count();

            $hours[] = [
                'time'     => $time,
                'disabled' => $bookedCount >= $slot->max_bookings,
            ];

            $opening->addHour();
        }

        return response()->json(['times' => $hours]);
    }
}
