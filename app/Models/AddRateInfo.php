<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AddRateInfo extends Model
{
    protected $guarded = [];

    public function rateInfoCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function rateInfoUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
