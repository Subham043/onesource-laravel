<?php

namespace App\Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\Notification\Mails\SendWriterNotificationEmail;
use Illuminate\Support\Facades\Mail;

class WriterNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    protected $data;
    protected $template;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user['email'])->send(new SendWriterNotificationEmail($this->user, $this->data, $this->template));
    }
}
