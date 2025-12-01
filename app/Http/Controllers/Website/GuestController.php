<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\DTOs\OfferDTO;
use Illuminate\Http\Request;
use App\Models\Guest;
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
            return response()->json([
                'success' => false,
                'message' => __('There was an error submitting your offer.'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
