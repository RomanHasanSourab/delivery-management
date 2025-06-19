<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $guarded = [];

    public function deliveryCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function deliveryUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deliveryTo(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function deliveryFrom(){
        return $this->belongsTo(District::class, 'district_id_from', 'id');
    }

    public function status(){
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status', 'id');
    }

    public function agent(){
        return $this->belongsTo(User::class, 'assigned_agent_id','id');
    }
}
