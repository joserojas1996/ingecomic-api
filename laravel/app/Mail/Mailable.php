<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable as MailMailable;
use Illuminate\Queue\SerializesModels;

class Mailable extends MailMailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->onQueue('mails')
            ->onConnection('database');
    }
}
