<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $guarded = [];

    public function aboutCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function aboutUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
