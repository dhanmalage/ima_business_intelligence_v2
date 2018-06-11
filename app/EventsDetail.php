<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsDetail extends Model
{
    protected $fillable = [
        'tickets_total',
        'imabi_event_status'
    ];
}
