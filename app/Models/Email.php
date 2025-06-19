<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    public function emailCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function emailUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
