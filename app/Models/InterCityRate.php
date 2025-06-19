<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class InterCityRate extends Model
{
    protected $guarded = [];

    public function cityRateCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function cityRateUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function cityRateDistrict(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function districtFrom()
    {
        return $this->belongsTo(District::class, 'district_id_from', 'id');
    }

    public function districtTo()
    {
        return $this->belongsTo(District::class, 'district_id_to', 'id');
    }
}
