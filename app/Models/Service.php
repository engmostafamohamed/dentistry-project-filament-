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

    public $translatable = ['title', 'description'];
    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_services');
    }

        /**
     * Get translated title for display (NOT as accessor)
     */
    public function getTranslatedTitle(): string
    {
        $title = $this->title;

        if (!is_array($title)) {
            return '-';
        }

        $locale = substr(app()->getLocale(), 0, 2);
        $primary = $title[$locale] ?? null;
        $fallback = $locale === 'ar' ? ($title['en'] ?? null) : ($title['ar'] ?? null);

        return $primary ?? $fallback ?? '-';
    }

    /**
     * Get translated description for display
     */
    public function getTranslatedDescription(): string
    {
        $description = $this->description;

        if (!is_array($description)) {
            return '';
        }

        $locale = substr(app()->getLocale(), 0, 2);
        $primary = $description[$locale] ?? null;
        $fallback = $locale === 'ar' ? ($description['en'] ?? null) : ($description['ar'] ?? null);

        return $primary ?? $fallback ?? '';
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

}
