<?php

namespace App\Models;

use App\Models\AboutUs;
use App\Models\AboutUsCard;
use App\Models\District;
use App\Models\Hub;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    const SuperAdmin = '1';
    const Branch = '2';
    const Merchant = '3';
    const Customer = '4';
    const DeliveryBoy = '5';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'shop_name', 'address', 'phone', 'role_id', 'district_id', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aboutCard()
    {
        return $this->hasOne(AboutUsCard::class);
    }

    public function about()
    {
        return $this->hasOne(AboutUs::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hubInfo(){
        return $this->hasOne(Hub::class, 'user_id', 'id');
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }
}
