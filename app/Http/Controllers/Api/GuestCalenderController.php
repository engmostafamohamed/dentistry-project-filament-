<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Doctor;
class GuestCalenderController extends Controller
{
    public function doctors()
    {
        return Doctor::where('is_active', true)->get(['id', 'name']);
    }

    public function index()
    {
        $guests = Guest::with('doctor')->whereNotNull('doctor_id')->get();

        return $guests->map(function ($guest) {
            return [
                'id' => $guest->id,
                'title' => $guest->name,
                'resourceId' => $guest->doctor_id,
                'start' => $guest->next_appointment_date ?? now(),
                'color' => match ($guest->status) {
                    'paid' => '#16a34a',
                    'cancelled' => '#ef4444',
                    'complete_treatment' => '#06b6d4',
                    'processing_in_treatment' => '#f59e0b',
                    default => '#9ca3af',
                },
            ];
        });
    }

    public function assign(Request $request, Guest $guest)
    {
        $guest->update(['doctor_id' => $request->doctor_id]);
        return response()->json(['success' => true]);
    }
}
