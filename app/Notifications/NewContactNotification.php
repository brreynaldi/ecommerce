<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotification extends Notification
{
    use Queueable;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['database']; // bisa ditambah 'mail' kalau mau email juga
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Pesan baru dari {$this->contact->name}",
            'contact_id' => $this->contact->id,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
        ];
    }
}
