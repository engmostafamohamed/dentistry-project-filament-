<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\DTOs\OfferDTO;
use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    public function storeOffer(OfferRequest $request)
    {
        try {
            $dto = OfferDTO::fromRequest($request);
            $guest = Guest::create($dto->toArray());

            return response()->json([
                'success' => true,
                'message' => __('Offer submitted successfully!'),
                'guest' => $guest,
            ]);
        } catch (\Exception $e) {
            Log::error('Offer booking failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => __('Something went wrong while booking.'),
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
