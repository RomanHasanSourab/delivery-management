<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AboutUsCard extends Model
{
    protected $guarded = [];

    public function aboutCardCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function aboutCardUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
