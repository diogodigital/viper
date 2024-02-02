<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMail extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'setting_mails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        // smtp
        'software_smtp_type',
        'software_smtp_mail_host',
        'software_smtp_mail_port',
        'software_smtp_mail_username',
        'software_smtp_mail_password',
        'software_smtp_mail_encryption',
        'software_smtp_mail_from_address',
        'software_smtp_mail_from_name',
    ];

    /**
     * Get the user's first name.
     */
    protected function softwareSmtpMailPassword(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => env('APP_DEMO') ? '*********************' : $value,
        );
    }


    protected $hidden = array('updated_at');
}
