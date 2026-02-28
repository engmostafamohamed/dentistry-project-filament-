<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Doctor extends Model
{
    use SoftDeletes;
    use HasTranslations;
    protected $fillable = ['name' ,'photo','phone','email','address','position','qualification','photo','certifications','awards','bio','branch_id','is_active'];
    protected $casts = [

        'is_active'=>'boolean',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_services');
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function availableSlots()
    {
        return $this->hasMany(AvailableSlot::class);
    }
    public function guests(){
        return $this->hasMany(Guest::class);
    }
    public function getNameAttribute($value): string
    {
        return $value ?: '-';
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
    
}
