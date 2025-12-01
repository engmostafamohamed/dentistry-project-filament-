<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Page extends Model
{
    use HasTranslations;

    protected $fillable = ['slug', 'title'];

    public $translatable = ['title'];

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }
}
