<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $primaryKey = "user_id";

    protected $fillable = [
        'user_id', 
        'group_id',
        'dob', 
        'ppa',
        'avatar',
        'state_code',
        'state',
        'lga',
        'first_name',
        'last_name',
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
