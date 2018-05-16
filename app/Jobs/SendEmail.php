<?php

namespace App\Jobs;

use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


	protected $message;
    /**
     * Create a new job instance.
     *
     *
     */
    public function __construct(Message $message)
    {
        //
		$this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		$toUser = User::find($this->message->t_id);
		$toUser->notify(new \App\Notifications\Message($this->message));
    }
}
