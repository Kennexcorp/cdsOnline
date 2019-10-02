<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'profile_user_id',
        'month',
        'week_1',
        'week_2',
        'week_3',
        'week_4'
        
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    
}
