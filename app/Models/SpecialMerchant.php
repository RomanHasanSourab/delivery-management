<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SpecialMerchant extends Model
{
    protected $guarded = [];

    public function sMCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function sMUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function merchantInfo(){
        return $this->belongsTo(User::class, 'merchant_id', 'id');
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
