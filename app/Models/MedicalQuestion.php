<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalQuestion extends Model
{
    //
    protected $fillable = [
        'template_id', 'question', 'type', 'options', 'is_required', 'order'
    ];
    public function template()
    {
        return $this->belongsTo(MedicalFormTemplate::class, 'template_id');
    }
}
