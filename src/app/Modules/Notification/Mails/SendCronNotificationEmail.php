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
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
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
        ]);
    }
}
