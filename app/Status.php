<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = [
        'name', 'style'
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    
}
