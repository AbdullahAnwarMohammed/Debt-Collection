<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoiceNew extends Notification
{
    use Queueable;

    private $invoiceData;
     
    public function __construct($invoiceData)
    {
        $this->invoiceData = $invoiceData;
    }
     
 
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->invoiceData['id']
        ];
    }
}
