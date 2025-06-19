<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Helpline extends Model
{
    protected $guarded = [];

    public function helplineCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function helplineUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
