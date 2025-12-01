<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Section extends Model
{
    use HasTranslations;
    protected $fillable = [
        'page_id',
        'key',
        'type',
        'header',
        'title',
        'description',
        'images',
        'points',
        'members',
        'order'
    ];

    protected $casts = [
        'images' => 'array',
        'points' => 'array',
        'members' => 'array',
    ];

    public $translatable = ['header', 'title', 'description'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
