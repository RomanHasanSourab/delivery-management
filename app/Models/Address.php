<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function addressCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function addressUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
