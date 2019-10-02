<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable = [
        'code',
        'name',
        
    ];

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function groups()
    {
        return $this->hasMany(SupervisorGroup::class);
    }

}
