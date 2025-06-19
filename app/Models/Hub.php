<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    protected $guarded = [];

    public function baseInfo(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
