<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class PaymentConfirmedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => "Customer {$this->order->user->name} sudah konfirmasi pembayaran untuk pesanan #{$this->order->id}.",
            'status' => $this->order->status,
            'total' => $this->order->total,
        ];
    }
}
