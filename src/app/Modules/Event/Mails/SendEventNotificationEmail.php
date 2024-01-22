<?php

namespace App\Modules\Event\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEventNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $data;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data, $type)
    {
        $this->user = $user;
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name').' - Event Notification')->view('emails.event_notification')->with([
            'user' => $this->user,
            'data' => $this->data,
            'type' => $this->type,
        ]);
    }
}
