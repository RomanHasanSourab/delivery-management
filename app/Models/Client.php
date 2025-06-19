<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function clientCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function clientUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
