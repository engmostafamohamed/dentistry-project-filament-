<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'guest_id', 'doctor_id', 'service_id', 'branch_id',
        'treatment_date', 'diagnosis', 'treatment_type', 'notes',
        'status'
    ];
    protected $casts = [
        'treatment_date' => 'date',
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
