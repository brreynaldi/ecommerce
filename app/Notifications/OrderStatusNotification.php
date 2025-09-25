<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderStatusNotification extends Notification
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
            'message' => "Status pesanan #{$this->order->id} diperbarui menjadi {$this->order->status}.",
            'status' => $this->order->status,
            'tracking_number' => $this->order->tracking_number,
        ];
    }
}
