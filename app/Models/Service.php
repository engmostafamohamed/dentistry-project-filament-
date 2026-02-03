<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'image', 'is_active'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',

        'is_active' => 'boolean',
    ];

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
    public function getTitleAttribute($value): string
    {
        $title = is_array($value) ? $value : json_decode($value, true);
        if (!is_array($title)) return '-';

        $locale = substr(app()->getLocale(), 0, 2);
        $primary = $title[$locale] ?? null;
        $fallback = $locale === 'ar' ? ($title['en'] ?? null) : ($title['ar'] ?? null);

        return $primary ?? $fallback ?? '-';
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_services');
    }

}
