<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Branch extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','address','phone','is_active','country_id','region_id'];


    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

    public function guest(){
        return $this->hasMany(Guest::class);
    }

    public function activeBranches($query){
        return $query->where('is_active',true);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
