<?php
namespace App\DTOs;

use App\Http\Requests\OfferRequest;

class OfferDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $phone,
        public readonly int $branch_id,
        public readonly ?int $doctor_id,
        public readonly int $offer_id,
        public readonly ?int $service_id,
        public readonly string $country,
        public readonly string $region,
        public readonly ?string $message,
    ) {}

    public static function fromRequest(OfferRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            phone: $request->input('phone'),
            branch_id: $request->input('branch_id'),
            doctor_id: $request->input('doctor_id'),
            offer_id: $request->input('offer_id'),
            service_id: $request->input('service_id'),
            country: $request->input('country'),
            region: $request->input('region'),
            message: $request->input('message'),
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'phone'       => $this->phone,
            'branch_id'   => $this->branch_id,
            'doctor_id'   => $this->doctor_id,
            'offer_id'    => $this->offer_id,
            'service_id'  => $this->service_id,
            'address'     => "{$this->region}, {$this->country}",
            'description' => $this->message,
            'status'      => 'new', // default status
        ];
    }
}
