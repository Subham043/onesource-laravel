<?php

namespace App\Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\Notification\Mails\SendCronNotificationEmail;
use Illuminate\Support\Facades\Mail;

class SingleClientNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $users;
    protected $data;
    protected $type;
    protected $notification_type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $data, $type, $notification_type)
    {
        $this->users = $users;
        $this->data = $data;
        $this->type = $type;
        $this->notification_type = $notification_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->users['email'])->send(new SendCronNotificationEmail($this->users, $this->data, $this->type, $this->notification_type));
    }
}
