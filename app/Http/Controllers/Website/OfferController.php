<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
class OfferController extends Controller
{
    public function checkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $exists = Guest::where('phone', $request->phone)
            ->where('status', 'new')
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
