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
        'certifications' => 'array',
        'awards' => 'array',
    ];
    public $translatable = ['name','position', 'qualification', 'bio'];
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function guests(){
        return $this->hasMany(Guest::class);
    }
}
