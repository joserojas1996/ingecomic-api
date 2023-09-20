<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PurchaseRequestSendToApproveNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $purchase;
    protected $user;

    public function __construct($purchase, $user)
    {
        $this->onQueue('mails')
            ->onConnection('database');

        $this->purchase = $purchase;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting("Hola {$this->user->full_name}")
            ->subject(Lang::get('Nueva Solicitud de Compra pendiente de aprobación'))
            ->line("Una nueva solicitud de compra de número: {$this->purchase->correlative_number} ha sido enviada para aprobación.")
            ->action('Ver solicitud', config('app.frontend_host') . "/purchase_requests/show/" . encrypt($this->purchase->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
