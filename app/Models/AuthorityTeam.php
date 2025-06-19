<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AuthorityTeam extends Model
{
    protected $guarded = [];

    public function authorityCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function authorityUpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
