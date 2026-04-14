<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingEvent extends Model
{
    protected $table = 'tracking_events';

    public $timestamps = false;

    protected $fillable = [
        'event_uuid',
        'event_name',
        'session_id',
        'page_url',
        'referrer',
        'occurred_at',
        'metadata',
        'user_ip',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'occurred_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}

