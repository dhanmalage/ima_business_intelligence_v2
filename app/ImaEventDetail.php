<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImaEventDetail extends Model
{
    protected $fillable = [
        'group',
        'web_ref_id',
        'reg_id',
        'pay_method',
        'reg_date',
        'pay_status',
        'pay_type',
        'transaction_id',
        'price',
        'coupon_code',
        'attendees',
        'amount_paid',
        'date_paid',
        'event_name',
        'price_option',
        'event_date',
        'event_time',
        'web_check_in',
        'tickets_scanned',
        'check_in_date',
        'seat_tag',
        'first_name',
        'last_name',
        'email',
        'phone',
        'created_at'
    ];

}
