<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];

    public function districtCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function districtUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    // public function childAreas()
    // {
    //     return $this->hasMany(Area::class, 'district_id', 'id');
    // }

    // public function interCityRates()
    // {
    //     return $this->hasMany(InterCityRate::class, 'district_id', 'id');
    // }



}
