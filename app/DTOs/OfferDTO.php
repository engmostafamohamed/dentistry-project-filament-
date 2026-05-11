<?php

namespace App\DTOs;

use App\Http\Requests\OfferRequest;
use App\Models\Country;
use App\Models\Region;
use Carbon\Carbon;

class OfferDTO
{
    public function __construct(
        public readonly string  $name,
        public readonly string  $phone,
        public readonly ?int    $branch_id,
        public readonly ?int    $doctor_id,
        public readonly ?int    $offer_id,
        public readonly ?int    $service_id,
        public readonly ?string $country,
        public readonly ?string $region,
        public readonly ?string $message,
        public readonly ?string $booking_at,
    ) {}

    public static function fromRequest(OfferRequest $request): self
    {
        $bookingAt = null;

        // Check each field separately — filled([...]) with array doesn't work
        if ($request->filled('date') && $request->filled('time')) {
            try {
                $bookingAt = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $request->input('date') . ' ' . $request->input('time')
                )->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $bookingAt = null;
            }
        }

        // Resolve country/region names from IDs for the address field
        // The form sends IDs (from the select dropdowns)
        $countryName = null;
        $regionName  = null;

        if ($request->filled('country')) {
            $country     = Country::find($request->input('country'));
            $locale      = app()->getLocale();
            $countryName = $country
                ? ($locale === 'ar' ? $country->name_ar : $country->name_en)
                : $request->input('country');
        }

        if ($request->filled('region')) {
            $region     = Region::find($request->input('region'));
            $locale     = app()->getLocale();
            $regionName = $region
                ? ($locale === 'ar' ? $region->name_ar : $region->name_en)
                : $request->input('region');
        }

        return new self(
            name:       $request->input('name'),
            phone:      $request->input('phone'),
            branch_id:  $request->filled('branch_id')  ? (int) $request->input('branch_id')  : null,
            doctor_id:  $request->filled('doctor_id')  ? (int) $request->input('doctor_id')  : null,
            offer_id:   $request->filled('offer_id')   ? (int) $request->input('offer_id')   : null,
            service_id: $request->filled('service_id') ? (int) $request->input('service_id') : null,
            country:    $countryName,
            region:     $regionName,
            message:    $request->input('message'),
            booking_at: $bookingAt,
        );
    }

    public function toArray(): array
    {
        $addressParts = array_filter([$this->region, $this->country]);

        return [
            'name'        => $this->name,
            'phone'       => $this->phone,
            'branch_id'   => $this->branch_id,
            'doctor_id'   => $this->doctor_id,
            'offer_id'    => $this->offer_id,
            'service_id'  => $this->service_id,
            'address'     => implode(', ', $addressParts) ?: null,
            'description' => $this->message,
            'booking_at'  => $this->booking_at,
            'status'      => 'new',
        ];
    }
}
