<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class PasswordResetSuccess extends Notification
{
    use Queueable;
    public $newPassword;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Change password successfully!')
        ->line('You have successfully changed the password.')
        ->line('This is your new password:')
        ->line(new HtmlString('<b style="text-align:center;color:blue;padding: 10px; margin: 20px auto;">'.$this->newPassword.'<b>'))
        ->line('Please login and change your password to ensure security.')
        ->line('Otherwise you ask for this. Please contact the administrator for assistance.');
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
