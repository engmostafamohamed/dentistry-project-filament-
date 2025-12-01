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
}
