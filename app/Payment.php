<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'email',
        'transaction_ref',
        'amount'
        
    ];
}
