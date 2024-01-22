<?php

namespace App\Modules\Event\Jobs;

use App\Modules\Event\Mails\SendEventNotificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $users;
    protected $data;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $data, $type)
    {
        $this->users = $users;
        $this->data = $data;
        $this->type = $type;
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
            Mail::to($user['email'])->send(new SendEventNotificationEmail($user, $this->data, $this->type));
        }
    }
}
