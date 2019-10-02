<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupervisorGroup extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'group_id', 
        'user_id', 
        'time',
        'day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
