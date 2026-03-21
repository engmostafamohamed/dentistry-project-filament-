<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name_en', 'name_ar'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    
    public function getNameAttribute(): string
    {
        $locale = app()->getLocale();

        // Use dynamic column based on locale
        $primary = $this->{'name_' . $locale} ?? null;

        // Fallback to the other language
        $fallback = $locale === 'ar' ? ($this->name_en ?? null) : ($this->name_ar ?? null);

        // Return primary, fallback, or '-' if both are null/empty
        return $primary ?: ($fallback ?: '-');
    }
}

