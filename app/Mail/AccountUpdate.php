<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user, public $option)
    {
    }
   
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Libotana')
                    ->subject('Libotana - Account Update')
                    ->markdown('emails.account_update', [
                        'user' => $this->user,
                        'option' => $this->option,
                        'url' => route('auth.login'),
        ]); // with params
    }
}