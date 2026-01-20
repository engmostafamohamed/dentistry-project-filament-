<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFormTemplate extends Model
{
    protected $fillable = [
        'title', 'description', 'is_active'
    ];

    public function questions()
    {
        return $this->hasMany(MedicalQuestion::class, 'template_id');
    }
}
