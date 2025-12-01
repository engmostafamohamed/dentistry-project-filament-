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
}

