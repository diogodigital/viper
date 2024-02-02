<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemWallet extends Model
{
    use HasFactory;

    protected $table = 'system_wallets';
    protected $appends = ['canPay'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'balance',
        'balance_min',
        'pay_upto_percentage',
        'mode',
    ];


    /**
     * @return mixed
     */
    public function getCanPayAttribute()
    {
        if($this->balance >= $this->balance_min) {
            return true;
        }

        return false;
    }
}
