<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;

    /**
     * @param $token
     */
    public function __construct($token)
    {
        $this->resetLink = url('/reset-password/' . $token);
    }

    /**
     * @return ResetPasswordMail
     */
    public function build()
    {
        return $this->view('emails.reset-password')
            ->subject('Redefinição de Senha')
            ->with(['resetLink' => $this->resetLink]);
    }
}
