<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PaymentRequests extends Model
{
    protected $guarded = [];

    public function requestCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function requestUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
