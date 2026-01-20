<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestMedicalFormLink extends Model
{
    protected $fillable = [
        'guest_id', 'template_id', 'token', 'sent_at', 'submitted_at', 'is_completed'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function template()
    {
        return $this->belongsTo(MedicalFormTemplate::class, 'template_id');
    }

    public function answers()
    {
        return $this->hasMany(GuestMedicalAnswer::class, 'form_link_id');
    }
}
