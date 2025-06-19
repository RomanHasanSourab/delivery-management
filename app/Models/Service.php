<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function serviceCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function serviceUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
