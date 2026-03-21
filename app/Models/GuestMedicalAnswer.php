<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestMedicalAnswer extends Model
{
    protected $fillable = [
        'guest_id', 'medical_question_id', 'form_link_id', 'answer', 'dentist_note'
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function question()
    {
        return $this->belongsTo(MedicalQuestion::class);
    }

    public function formLink()
    {
        return $this->belongsTo(GuestMedicalFormLink::class, 'form_link_id');
    }
}
