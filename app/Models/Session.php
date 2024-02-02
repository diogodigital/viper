<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
        'country',
        'city',
        'os',
        'device',
        'browser',
    ];
}
