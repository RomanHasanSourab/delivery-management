<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function invCreator(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
