<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name_en', 'name_ar'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function getNameAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'ar' ? $this->name_ar : $this->name_en;
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}

