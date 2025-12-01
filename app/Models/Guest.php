<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Guest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','phone','email','address','description',
        'status','branch_id','doctor_id','offer_id','service_id'
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
    public function offer() {
        return $this->belongsTo(Offer::class);
    }
    public function service() {
        return $this->belongsTo(Service::class);
    }
}
