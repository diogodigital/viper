<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuitPayPayment extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suit_pay_payments';
    protected $appends = ['dateHumanReadable', 'createdAt'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
        'user_id',
        'withdrawal_id',
        'pix_key',
        'pix_type',
        'amount',
        'observation',
        'status'
    ];


    /**
     * Get the user's first name.
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->getStatus($value),
        );
    }

    /**
     * @param $status
     * @return string|void
     */
    private function getStatus($status)
    {
        switch ($status) {
            case '1':
                return 'pago';
            case '0':
                return 'pendente';
        }
    }

    /**
     * @return mixed
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    /**
     * @return mixed
     */
    public function getDateHumanReadableAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
