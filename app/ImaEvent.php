<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImaEvent extends Model
{
    protected $fillable = [
        'tickets_total',
        'status'
    ];
}
