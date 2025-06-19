<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function areaCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function areaUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

}
