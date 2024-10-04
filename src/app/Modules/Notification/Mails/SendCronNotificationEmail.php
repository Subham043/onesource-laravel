<?php

namespace App\Modules\Notification\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCronNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $data;
    private $type;
    private $notification_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data, $type, $notification_type)
    {
        $this->user = $user;
        $this->data = $data;
        $this->type = $type;
        $this->notification_type = $notification_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name').' - Event Notification')->view('emails.cron_client_notification')->with([
            'user' => $this->user,
            'data' => $this->data,
            'type' => $this->type,
            'notification_type' => $this->notification_type
        ]);
    }
}
