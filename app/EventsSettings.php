<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsSettings extends Model
{
    protected $fillable = [
        'tickets_total',
        'event_status'
    ];
}
