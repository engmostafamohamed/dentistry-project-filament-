<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Doctor extends Model
{
    use SoftDeletes;
    use HasTranslations;
    protected $fillable = ['name' ,'position','qualification','photo','certifications','awards','bio','branch_id'];
    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'qualification' => 'array',
        'certifications' => 'array',
        'awards' => 'array',
        'photo' => 'array',
        'bio' => 'array',
    ];

    public $translatable = ['name','position', 'qualification', 'bio'];
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function guests(){
        return $this->hasMany(Guest::class);
    }
    public function getNameAttribute(): string
    {
        if (! is_array($this->name)) {
            return '-';
        }

        $locale = app()->getLocale();

        $primary = $this->name[$locale] ?? null;
        $fallback = $locale === 'ar'
            ? ($this->name['en'] ?? null)
            : ($this->name['ar'] ?? null);

        return $primary ?? $fallback ?? '-';
    }

}
