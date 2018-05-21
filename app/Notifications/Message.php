<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class Message extends Notification implements ShouldQueue
{
    use Queueable;

	protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Message $message)
    {
        //
		$this->message = $message;
		Log::info("{$this->message->title} to {$this->message->t_id} form {$this->message->f_id}");
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
    	$title = $this->message->title;
		$href = $this->message->href;
		$content = $this->message->content;
        return (new MailMessage)
                    ->line("$title")
                    ->action('查看详情', url("$href"))
                    ->line("$content");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
