<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gateways';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        // Suitpay
        'suitpay_uri',
        'suitpay_cliente_id',
        'suitpay_cliente_secret',

        // Stripe
        'bspay_uri',
        'bspay_cliente_id',
        'bspay_cliente_secret',

        // Sqala
        'sqala_app_id',
        'sqala_app_secret',
        'sqala_access_token',
    ];

    protected $hidden = array('updated_at');

    /**
     * Get the user's first name.
     */
    protected function suitpayClienteId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => env('APP_DEMO') ? '*********************' : $value,
        );
    }

    /**
     * Get the user's first name.
     */
    protected function suitpayClienteSecret(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => env('APP_DEMO') ? '*********************' : $value,
        );
    }

    /**
     * Get the user's first name.
     */
    protected function bspayClienteId(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => env('APP_DEMO') ? '*********************' : $value,
        );
    }

    /**
     * Get the user's first name.
     */
    protected function bspayClienteSecret(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => env('APP_DEMO') ? '*********************' : $value,
        );
    }

}
