<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','description','image','is_active','expires_at','discount'];
    protected $dates = ['expires_at'];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];
    public function guests() {
        return $this->hasMany(Guest::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function availableOffers($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

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
