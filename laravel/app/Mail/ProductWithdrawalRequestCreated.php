<?php

namespace App\Mail;

use App\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductWithdrawalRequestCreated extends Mailable implements ShouldQueue
{
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = "https://intranet.colegiosantajoaquina.cl/products/answerable";

        parent::__construct();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nueva Solicitud de Retiro de Producto")->markdown('emails.productwithdrawal.created');
    }
}
