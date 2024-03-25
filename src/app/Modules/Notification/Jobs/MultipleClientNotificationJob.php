<?php

namespace App\Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\Notification\Mails\SendMultipleClientNotificationEmail;
use Illuminate\Support\Facades\Mail;

class MultipleClientNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $users;
    protected $data;
    protected $template;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $data, $template)
    {
        $this->users = $users;
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            # code...
            Mail::to($user['email'])->send(new SendMultipleClientNotificationEmail($user, $this->data, $this->template));
        }
    }
}