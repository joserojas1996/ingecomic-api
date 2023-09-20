<?php

namespace App\Mail\Test;

use App\Mail\Mailable;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTest extends Mailable implements ShouldQueue
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail de testeo')
            ->view('emails.mail-test', [
                'date' => Carbon::now()->format('d-m-Y H:i')
            ]);
    }
}
