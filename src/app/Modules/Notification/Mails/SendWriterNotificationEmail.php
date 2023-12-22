<?php

namespace App\Modules\Notification\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWriterNotificationEmail extends Mailable
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
    public function __construct($user, $data, $template)
    {
        $this->user = $user;
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name').' - Event Notification')->view('emails.writer_notification')->with([
            'user' => $this->user,
            'data' => $this->data,
            'template' => $this->template,
        ]);
    }
}
